<?php

namespace App\Support\Visitors;

use App\Models\VisitorVisit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class VisitorAnalyticsService
{
    public function dashboard(): array
    {
        $currentStart = now()->startOfMonth();
        $currentEnd = now()->endOfMonth();
        $previousStart = now()->subMonthNoOverflow()->startOfMonth();
        $previousEnd = now()->subMonthNoOverflow()->endOfMonth();

        $browserBreakdown = $this->decorateBreakdown(
            $this->breakdown('browser_name', $currentStart, $currentEnd),
            'browser'
        );

        $osBreakdown = $this->decorateBreakdown(
            $this->breakdown('os_name', $currentStart, $currentEnd),
            'os'
        );

        $currentVisitors = $this->distinctVisitors($currentStart, $currentEnd);
        $previousVisitors = $this->distinctVisitors($previousStart, $previousEnd);

        return [
            'periodLabel' => $currentStart->translatedFormat('F Y'),
            'browserCards' => $browserBreakdown->take(4)->values(),
            'browserBreakdown' => $browserBreakdown->values(),
            'osBreakdown' => $osBreakdown->values(),
            'dailyTrend' => $this->dailyTrend($currentStart, $currentEnd),
            'summary' => [
                'current_visitors' => $currentVisitors,
                'previous_visitors' => $previousVisitors,
                'current_page_views' => $this->pageViews($currentStart, $currentEnd),
                'current_bots' => $this->distinctVisitors($currentStart, $currentEnd, true),
                'change_label' => $this->buildChangeLabel($currentVisitors, $previousVisitors),
            ],
        ];
    }

    private function breakdown(string $dimension, Carbon $start, Carbon $end): Collection
    {
        $this->assertSupportedDimension($dimension);

        $rows = VisitorVisit::query()
            ->select($dimension)
            ->selectRaw('COUNT(DISTINCT visitor_key) as visitors')
            ->selectRaw('SUM(page_views) as page_views')
            ->whereBetween('visited_on', [$start->toDateString(), $end->toDateString()])
            ->groupBy($dimension)
            ->orderByDesc('visitors')
            ->get()
            ->map(fn ($row) => [
                'label' => $this->normalizeBreakdownLabel($row->{$dimension}),
                'visitors' => (int) $row->visitors,
                'page_views' => (int) $row->page_views,
            ])
            ->groupBy('label')
            ->map(fn (Collection $group, string $label) => [
                'label' => $label,
                'visitors' => $group->sum('visitors'),
                'page_views' => $group->sum('page_views'),
            ])
            ->sortByDesc('visitors')
            ->values();

        if ($rows->count() <= 4) {
            return $rows;
        }

        $topRows = $rows->take(4);
        $otherRows = $rows->slice(4);

        return $topRows->push([
            'label' => 'Lainnya',
            'visitors' => $otherRows->sum('visitors'),
            'page_views' => $otherRows->sum('page_views'),
        ]);
    }

    private function normalizeBreakdownLabel(mixed $value): string
    {
        $label = trim((string) ($value ?? ''));

        return $label === '' ? 'Unknown' : $label;
    }

    private function decorateBreakdown(Collection $rows, string $dimension): Collection
    {
        return $rows->map(function (array $row) use ($dimension) {
            $style = $this->styleFor($dimension, $row['label']);

            return array_merge($row, $style);
        });
    }

    /**
     * @return array{labels: array<int, string>, visitors: array<int, int>, page_views: array<int, int>}
     */
    private function dailyTrend(Carbon $start, Carbon $end): array
    {
        $dailyRows = VisitorVisit::query()
            ->selectRaw('visited_on')
            ->selectRaw('COUNT(DISTINCT visitor_key) as visitors')
            ->selectRaw('SUM(page_views) as page_views')
            ->whereBetween('visited_on', [$start->toDateString(), $end->toDateString()])
            ->groupBy('visited_on')
            ->orderBy('visited_on')
            ->get()
            ->keyBy(fn ($row) => Carbon::parse($row->visited_on)->toDateString());

        $labels = [];
        $visitors = [];
        $pageViews = [];

        foreach (CarbonPeriod::create($start, $end) as $date) {
            $key = $date->toDateString();
            $row = $dailyRows->get($key);

            $labels[] = $date->format('d M');
            $visitors[] = (int) ($row->visitors ?? 0);
            $pageViews[] = (int) ($row->page_views ?? 0);
        }

        return [
            'labels' => $labels,
            'visitors' => $visitors,
            'page_views' => $pageViews,
        ];
    }

    private function distinctVisitors(Carbon $start, Carbon $end, ?bool $isBot = null): int
    {
        $query = VisitorVisit::query()
            ->whereBetween('visited_on', [$start->toDateString(), $end->toDateString()]);

        if ($isBot !== null) {
            $query->where('is_bot', $isBot);
        }

        return $this->countDistinct($query, 'visitor_key');
    }

    private function pageViews(Carbon $start, Carbon $end): int
    {
        return (int) VisitorVisit::query()
            ->whereBetween('visited_on', [$start->toDateString(), $end->toDateString()])
            ->sum('page_views');
    }

    private function countDistinct(Builder $query, string $column): int
    {
        return (int) (clone $query)
            ->selectRaw("COUNT(DISTINCT {$column}) as aggregate")
            ->value('aggregate');
    }

    private function buildChangeLabel(int $currentVisitors, int $previousVisitors): string
    {
        if ($previousVisitors === 0) {
            return $currentVisitors > 0
                ? 'Traffic baru mulai tercatat bulan ini'
                : 'Belum ada traffic yang tercatat';
        }

        $change = round((($currentVisitors - $previousVisitors) / $previousVisitors) * 100, 1);

        if ($change === 0.0) {
            return 'Stabil dibanding bulan lalu';
        }

        return sprintf(
            '%s%s%% dibanding bulan lalu',
            $change > 0 ? '+' : '',
            number_format($change, 1)
        );
    }

    private function assertSupportedDimension(string $dimension): void
    {
        if (! in_array($dimension, ['browser_name', 'os_name'], true)) {
            throw new \InvalidArgumentException("Unsupported analytics dimension [{$dimension}].");
        }
    }

    /**
     * @return array{color: string, icon: string}
     */
    private function styleFor(string $dimension, string $label): array
    {
        $styles = $dimension === 'browser'
            ? [
                'Chrome' => ['color' => 'info', 'icon' => 'fa-chrome'],
                'Firefox' => ['color' => 'danger', 'icon' => 'fa-firefox'],
                'Googlebot' => ['color' => 'success', 'icon' => 'fa-bug'],
                'Bingbot' => ['color' => 'primary', 'icon' => 'fa-bug'],
                'Safari' => ['color' => 'primary', 'icon' => 'fa-safari'],
                'Edge' => ['color' => 'secondary', 'icon' => 'fa-edge'],
                'Opera' => ['color' => 'warning', 'icon' => 'fa-opera'],
                'Internet Explorer' => ['color' => 'dark', 'icon' => 'fa-internet-explorer'],
                'Lainnya' => ['color' => 'success', 'icon' => 'fa-globe'],
                'Other' => ['color' => 'success', 'icon' => 'fa-globe'],
                'Unknown' => ['color' => 'secondary', 'icon' => 'fa-question-circle'],
            ]
            : [
                'Windows' => ['color' => 'primary', 'icon' => 'fa-windows'],
                'macOS' => ['color' => 'secondary', 'icon' => 'fa-apple'],
                'Linux' => ['color' => 'warning', 'icon' => 'fa-linux'],
                'Android' => ['color' => 'success', 'icon' => 'fa-android'],
                'iOS' => ['color' => 'info', 'icon' => 'fa-mobile'],
                'iPadOS' => ['color' => 'info', 'icon' => 'fa-tablet'],
                'Chrome OS' => ['color' => 'primary', 'icon' => 'fa-laptop'],
                'Lainnya' => ['color' => 'success', 'icon' => 'fa-desktop'],
                'Unknown' => ['color' => 'secondary', 'icon' => 'fa-question-circle'],
            ];

        return $styles[$label] ?? ['color' => 'secondary', 'icon' => 'fa-globe'];
    }
}
