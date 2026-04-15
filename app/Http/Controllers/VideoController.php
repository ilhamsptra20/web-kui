<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        return view('modules.video.index');
    }
    public function list()
    {
        return datatables()
            ->of(Video::query()->latest())
            ->addIndexColumn()
            ->addColumn('video_identity', fn (Video $row): string => AdminTable::image(\App\Models\Setting::resolveImageUrl($row->thumbnail), $row->trans('title') ?: '-', null))
            ->addColumn('video_link', fn (Video $row): string => AdminTable::externalLink($row->video_url))
            ->addColumn('updated_at_label', fn (Video $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.video.action', compact('row'))->render())
            ->rawColumns(['video_identity', 'video_link', 'updated_at_label', 'action'])
            ->toJson();
    }

    public function create()
    {

        return view('modules.video.form');
    }

    public function store(StoreVideoRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $request->file('thumbnail')->store('modules/videos', 'public');
            }

            $video = Video::create($data);

            DB::commit();

            return redirect()->route('videos.show', $video)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Video $video)
    {

        return view('modules.video.show', compact('video'));
    }

    public function edit(Video $video)
    {

        return view('modules.video.form', compact('video'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('thumbnail')) {
                if ($video->thumbnail) {
                    Storage::disk('public')->delete($video->thumbnail);
                }

                $data['thumbnail'] = $request->file('thumbnail')->store('modules/videos', 'public');
            }

            $video->update($data);

            DB::commit();

            return redirect()->route('videos.show', $video)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Video $video)
    {
        DB::beginTransaction();

        try {
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }

            $video->delete();

            DB::commit();

            return redirect()->route('videos.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('videos.index')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
