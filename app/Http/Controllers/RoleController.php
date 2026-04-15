<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        return view('modules.role.index');
    }

    public function list()
    {
        return datatables()
            ->of(Role::query()->withCount(['users', 'permissions']))
            ->addIndexColumn()
            ->addColumn('role_identity', function (Role $row): string {
                $name = e($row->name);
                $slug = e($row->slug);

                return "<div>
                            <div class=\"font-weight-semibold\">{$name}</div>
                            <small class=\"text-muted\">{$slug}</small>
                        </div>";
            })
            ->addColumn('status_badge', function (Role $row): string {
                return $row->is_active
                    ? '<span class="badge badge-light-success">Active</span>'
                    : '<span class="badge badge-light-secondary">Inactive</span>';
            })
            ->addColumn('user_count', fn (Role $row): string => (string) $row->users_count)
            ->addColumn('permission_count', fn (Role $row): string => (string) $row->permissions_count)
            ->addColumn('action', fn (Role $row): string => view('modules.role.action', compact('row'))->render())
            ->rawColumns(['role_identity', 'status_badge', 'action'])
            ->toJson();
    }

    public function create()
    {
        return view('modules.role.form', $this->formData());
    }

    public function store(StoreRoleRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $permissions = $data['permissions'] ?? [];
            unset($data['permissions']);

            $role = Role::create($data);
            $role->permissions()->sync($permissions);

            DB::commit();

            return redirect()->route('roles.show', $role)->with('success', 'Role berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal membuat role.');
        }
    }

    public function show(Role $role)
    {
        $role->load('permissions', 'users');

        return view('modules.role.show', $this->formData($role));
    }

    public function edit(Role $role)
    {
        $role->load('permissions');

        return view('modules.role.form', $this->formData($role));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $permissions = $data['permissions'] ?? [];
            unset($data['permissions']);

            $role->update($data);
            $role->permissions()->sync($permissions);

            DB::commit();

            return redirect()->route('roles.show', $role)->with('success', 'Role berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal memperbarui role.');
        }
    }

    public function destroy(Role $role)
    {
        DB::beginTransaction();

        try {
            $role->permissions()->detach();
            $role->users()->detach();
            $role->delete();

            DB::commit();

            return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('roles.index')->with('error', 'Gagal menghapus role: ' . $e->getMessage());
        }
    }

    private function formData(?Role $role = null): array
    {
        return [
            'role' => $role,
            'permissionOptions' => Permission::query()->active()->orderBy('group')->orderBy('name')->get(),
        ];
    }
}
