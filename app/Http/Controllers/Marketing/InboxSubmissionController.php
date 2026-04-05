<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicInboxRequest;
use App\Models\Inbox;

class InboxSubmissionController extends Controller
{
    public function store(StorePublicInboxRequest $request)
    {
        Inbox::query()->create([
            'name' => $request->string('name')->trim()->value(),
            'email' => $request->string('email')->trim()->lower()->value(),
            'subject' => $request->string('subject')->trim()->value() ?: null,
            'message' => $request->string('message')->trim()->value(),
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan Anda sudah terkirim ke inbox KUI. Tim kami akan menindaklanjuti secepatnya.');
    }
}
