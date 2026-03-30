<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class EventController extends Controller
{
    const PER_PAGE = 9;

    public function index(Request $request)
    {
        $breadcrumb = [
            'title' => 'Agenda',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'AGENDA', 'url' => null],
            ],
        ];

        $agendas = Agenda::latest('start_date')
            ->paginate(self::PER_PAGE);

        return view('pages.marketing.events.index', compact(
            'breadcrumb',
            'agendas'
        ));
    }

    public function show(string $slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();

        $breadcrumb = [
            'title' => 'Detail Agenda',
            'menus' => [
                ['label' => 'HOME',   'url' => '/'],
                ['label' => 'AGENDA', 'url' => '/agenda'],
                ['label' => strtoupper($agenda->trans('name')), 'url' => null],
            ],
        ];

        // Prev / Next
        $prev = Agenda::where('start_date', '<', $agenda->start_date)->latest('start_date')->first();
        $next = Agenda::where('start_date', '>', $agenda->start_date)->oldest('start_date')->first();

        return view('pages.marketing.events.show', compact(
            'breadcrumb',
            'agenda',
            'prev',
            'next'
        ));
    }
}