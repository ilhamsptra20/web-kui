<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Http\Requests\StoreSocialMediaRequest;
use App\Http\Requests\UpdateSocialMediaRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;

class SocialMediaController extends Controller
{
    public function index()
    {
        return view('modules.social_media.index');
    }
    public function list()
    {
        return datatables()
            ->of(SocialMedia::query()->latest())
            ->addIndexColumn()
            ->addColumn('social_identity', fn (SocialMedia $row): string => AdminTable::stack($row->name ?: '-', $row->icon ?: null))
            ->addColumn('link_label', fn (SocialMedia $row): string => AdminTable::externalLink($row->link))
            ->addColumn('updated_at_label', fn (SocialMedia $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.social_media.action', compact('row'))->render())
            ->rawColumns(['social_identity', 'link_label', 'updated_at_label', 'action'])
            ->toJson();
    }

    public function create()
    {

        return view('modules.social_media.form');
    }

    public function store(StoreSocialMediaRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $social_media = SocialMedia::create($data);

            DB::commit();

            return redirect()->route('social_media.show', $social_media)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(SocialMedia $social_media)
    {

        return view('modules.social_media.show', compact('social_media'));
    }

    public function edit(SocialMedia $social_media)
    {

        return view('modules.social_media.form', compact('social_media'));
    }

    public function update(UpdateSocialMediaRequest $request, SocialMedia $social_media)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $social_media->update($data);

            DB::commit();

            return redirect()->route('social_media.show', $social_media)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(SocialMedia $social_media)
    {
        DB::beginTransaction();

        try {

            $social_media->delete();

            DB::commit();

            return redirect()->route('social_media.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}
