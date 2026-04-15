<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        return view('modules.permission.index');
    }

    public function list()
    {
        return datatables()
            ->of(Permission::query()->withCount('roles'))
            ->addIndexColumn()
            ->addColumn('permission_identity', function (Permission $row): string {
                $name = e($row->name);
                $slug = e($row->slug);

                return "<div>
                            <div class=\"font-weight-semibold\">{$name}</div>
                            <small class=\"text-muted\">{$slug}</small>
                        </div>";
            })
            ->addColumn('group_badge', function (Permission $row): string {
                $label = e($row->group ?: 'general');

                return "<span class=\"badge badge-light-primary\">{$label}</span>";
            })
            ->addColumn('status_badge', function (Permission $row): string {
                return $row->is_active
                    ? '<span class="badge badge-light-success">Active</span>'
                    : '<span class="badge badge-light-secondary">Inactive</span>';
            })
            ->addColumn('role_count', fn (Permission $row): string => (string) $row->roles_count)
            ->addColumn('action', fn (Permission $row): string => view('modules.permission.action', compact('row'))->render())
            ->rawColumns(['permission_identity', 'group_badge', 'status_badge', 'action'])
            ->toJson();
    }

    public function create()
    {
        return view('modules.permission.form');
    }

    public function store(StorePermissionRequest $request)
    {
        DB::beginTransaction();

        try {
            $permission = Permission::create($request->validated());

            DB::commit();

            return redirect()->route('permissions.show', $permission)->with('success', 'Permission berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal membuat permission.');
        }
    }

    public function show(Permission $permission)
    {
        $permission->load('roles');

        return view('modules.permission.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('modules.permission.form', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        DB::beginTransaction();

        try {
            $permission->update($request->validated());

            DB::commit();

            return redirect()->route('permissions.show', $permission)->with('success', 'Permission berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal memperbarui permission.');
        }
    }

    public function destroy(Permission $permission)
    {
        DB::beginTransaction();

        try {
            $permission->roles()->detach();
            $permission->delete();

            DB::commit();

            return redirect()->route('permissions.index')->with('success', 'Permission berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('permissions.index')->with('error', 'Gagal menghapus permission: ' . $e->getMessage());
        }
    }
}
