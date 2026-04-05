<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Team;
use App\Services\SettingService;

class TeamController extends Controller
{
    public function index(SettingService $settingService)
    {
        $settings = $settingService->only([
            'team_page_subtitle' => 'TIM KUI UNIDA',
            'team_page_title' => 'Tim KUI Universitas Juanda Yang Mendukung Jejaring Dan Layanan Internasional Kampus',
            'team_page_description' => 'Kenali tim Kantor Urusan Internasional Universitas Juanda yang berperan dalam pengelolaan kerja sama global, mobilitas akademik, komunikasi internasional, dan dukungan layanan untuk sivitas akademika.',
            'team_page_highlight_title' => 'Kolaboratif, Responsif, Dan Siap Mendampingi Program Internasional',
            'team_page_highlight_description' => 'Setiap anggota tim KUI Unida hadir untuk memastikan proses komunikasi, fasilitasi, dan koordinasi internasional berjalan lebih terarah dan profesional.',
            'team_page_cta_title' => 'Butuh Dukungan Atau Ingin Berkolaborasi Dengan Tim KUI?',
            'team_page_cta_description' => 'Hubungi kami untuk keperluan kerja sama internasional, mobilitas mahasiswa, promosi kampus, atau koordinasi kunjungan akademik.',
            'team_page_cta_button_text' => 'Hubungi KUI',
            'team_page_cta_button_url' => route('contact-marketing'),
        ]);

        $teams = Team::query()
            ->with('position')
            ->orderBy('position_id')
            ->orderBy('name')
            ->paginate(9)
            ->through(fn (Team $team) => [
                'id' => $team->id,
                'slug' => $team->slug,
                'name' => $team->name,
                'npp' => $team->npp,
                'bio' => $team->trans('bio'),
                'position' => $team->position?->trans('name'),
                'image_url' => Setting::resolveImageUrl($team->image),
            ]);

        return view('pages.marketing.team.index', [
            'teamPage' => $settings,
            'teams' => $teams,
            'teamStats' => [
                'members' => Team::query()->count(),
                'positions' => Team::query()->whereNotNull('position_id')->distinct('position_id')->count('position_id'),
            ],
        ]);
    }

    public function show(Team $team, SettingService $settingService)
    {
        $team->load('position');

        $settings = $settingService->only([
            'team_page_subtitle' => 'TIM KUI UNIDA',
            'team_page_cta_title' => 'Bangun Komunikasi Internasional Dengan Tim KUI',
            'team_page_cta_description' => 'Tim KUI Unida siap membantu koordinasi kerja sama, layanan mobilitas, dan komunikasi kelembagaan internasional.',
            'team_page_cta_button_text' => 'Hubungi KUI',
            'team_page_cta_button_url' => route('contact-marketing'),
        ]);

        $relatedTeams = Team::query()
            ->with('position')
            ->whereKeyNot($team->getKey())
            ->when($team->position_id, fn ($query) => $query->where('position_id', $team->position_id))
            ->orderBy('name')
            ->take(3)
            ->get()
            ->map(fn (Team $item) => [
                'slug' => $item->slug,
                'name' => $item->name,
                'position' => $item->position?->trans('name'),
                'image_url' => Setting::resolveImageUrl($item->image),
            ]);

        if ($relatedTeams->isEmpty()) {
            $relatedTeams = Team::query()
                ->with('position')
                ->whereKeyNot($team->getKey())
                ->orderBy('name')
                ->take(3)
                ->get()
                ->map(fn (Team $item) => [
                    'slug' => $item->slug,
                    'name' => $item->name,
                    'position' => $item->position?->trans('name'),
                    'image_url' => Setting::resolveImageUrl($item->image),
                ]);
        }

        return view('pages.marketing.team.show', [
            'teamPage' => $settings,
            'team' => [
                'id' => $team->id,
                'slug' => $team->slug,
                'name' => $team->name,
                'npp' => $team->npp,
                'bio' => $team->trans('bio'),
                'position' => $team->position?->trans('name'),
                'image_url' => Setting::resolveImageUrl($team->image),
            ],
            'relatedTeams' => $relatedTeams,
        ]);
    }
}
