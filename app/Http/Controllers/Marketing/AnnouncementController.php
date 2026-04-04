<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $breadcrumb = [
            'title' => 'Announcements',
            'menus' => [
                ['label' => 'HOME',          'url' => '/'],
                ['label' => 'ANNOUNCEMENTS', 'url' => null],
            ],
        ];

        $announcements = Announcement::active()
            ->latest()
            ->paginate(self::PER_PAGE);

        return view('pages.marketing.announcements.index', compact(
            'breadcrumb',
            'announcements'
        ));
    }

    public function show(string $id)
    {
        $announcement = Announcement::where('is_active', true)
            ->findOrFail($id);

        $breadcrumb = [
            'title' => 'Detail Pengumuman',
            'menus' => [
                ['label' => 'HOME',          'url' => '/'],
                ['label' => 'ANNOUNCEMENTS', 'url' => route('announcements-marketing')],
                ['label' => strtoupper(Str::limit($announcement->trans('title'), 30)), 'url' => null],
            ],
        ];

        $prev = Announcement::where('is_active', true)
            ->where('created_at', '<', $announcement->created_at)
            ->latest()
            ->first();

        $next = Announcement::where('is_active', true)
            ->where('created_at', '>', $announcement->created_at)
            ->oldest()
            ->first();

        return view('pages.marketing.announcements.show', compact(
            'breadcrumb',
            'announcement',
            'prev',
            'next'
        ));
    }
}
