<?php

namespace App\Support\Visitors;

use App\Models\VisitorVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VisitorTracker
{
    public function __construct(
        private readonly UserAgentParser $parser,
    ) {
    }

    public function track(Request $request): void
    {
        $today = now();
        $visitedOn = $today->toDateString();
        $sessionId = $request->hasSession() ? $request->session()->getId() : null;
        $userAgent = (string) $request->userAgent();
        $identity = $sessionId ?: implode('|', [
            Str::lower($userAgent),
            $request->ip() ?: 'unknown-ip',
        ]);
        $visitorKey = hash('sha256', $identity);

        $details = $this->parser->parse($userAgent);
        $path = $this->normalizePath($request->path());

        $visit = VisitorVisit::query()->firstOrNew([
            'visitor_key' => $visitorKey,
            'visited_on' => $visitedOn,
        ]);

        if (! $visit->exists) {
            $visit->fill([
                'session_id' => $sessionId,
                'first_path' => $path,
                'browser_name' => $details['browser_name'],
                'browser_version' => $details['browser_version'],
                'os_name' => $details['os_name'],
                'os_version' => $details['os_version'],
                'device_type' => $details['device_type'],
                'is_bot' => $details['is_bot'],
                'first_visited_at' => $today,
                'page_views' => 0,
            ]);
        }

        $visit->fill([
            'route_name' => $request->route()?->getName(),
            'last_path' => $path,
            'last_visited_at' => $today,
            'browser_name' => $details['browser_name'],
            'browser_version' => $details['browser_version'],
            'os_name' => $details['os_name'],
            'os_version' => $details['os_version'],
            'device_type' => $details['device_type'],
            'is_bot' => $details['is_bot'],
        ]);

        $visit->page_views = (int) $visit->page_views + 1;
        $visit->save();
    }

    private function normalizePath(string $path): string
    {
        $normalized = '/'.ltrim($path, '/');

        return $normalized === '//' ? '/' : $normalized;
    }
}
