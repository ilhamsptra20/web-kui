<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('modules.user.index');
    }

    public function list()
    {
        return datatables()
            ->of(User::query()->with('roles:id,name')->select('users.*'))
            ->addIndexColumn()
            ->addColumn('user_identity', function (User $row): string {
                $name = e($row->name);
                $email = e($row->email);

                return "<div>
                            <div class=\"font-weight-semibold\">{$name}</div>
                            <small class=\"text-muted\">{$email}</small>
                        </div>";
            })
            ->addColumn('verified_badge', function (User $row): string {
                if ($row->email_verified_at) {
                    return '<span class="badge badge-light-success">Verified</span>';
                }

                return '<span class="badge badge-light-secondary">Unverified</span>';
            })
            ->addColumn('roles_badge', function (User $row): string {
                if ($row->roles->isEmpty()) {
                    return '<span class="badge badge-light-secondary">No Role</span>';
                }

                return $row->roles
                    ->map(fn (Role $role): string => '<span class="badge badge-light-primary mr-50">'.e($role->name).'</span>')
                    ->implode('');
            })
            ->addColumn('joined_at', fn (User $row): string => optional($row->created_at)?->format('d M Y, H:i') ?? '-')
            ->addColumn('action', fn (User $row): string => view('modules.user.action', compact('row'))->render())
            ->rawColumns(['user_identity', 'verified_badge', 'roles_badge', 'action'])
            ->toJson();
    }

    public function create()
    {
        return view('modules.user.form', $this->formData());
    }

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();

        try {
            $payload = $request->validated();
            $roles = $payload['roles'] ?? [];
            unset($payload['roles']);

            $data = $this->normalizeData($payload);

            $user = User::create($data);
            $user->syncRoles($roles);

            DB::commit();

            return redirect()->route('users.show', $user)->with('success', 'User berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal membuat user.');
        }
    }

    public function show(User $user)
    {
        return view('modules.user.show', $this->formData($user));
    }

    public function edit(User $user)
    {
        return view('modules.user.form', $this->formData($user));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $payload = $request->validated();
            $roles = $payload['roles'] ?? [];
            unset($payload['roles']);

            $data = $this->normalizeData($payload, $user);

            $user->update($data);
            $user->syncRoles($roles);

            DB::commit();

            return redirect()->route('users.show', $user)->with('success', 'User berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal memperbarui user.');
        }
    }

    public function destroy(User $user)
    {
        if ((int) auth()->id() === (int) $user->id) {
            return back()->with('error', 'User yang sedang login tidak boleh dihapus.');
        }

        DB::beginTransaction();

        try {
            $user->roles()->detach();
            $user->delete();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Gagal menghapus user.');
        }
    }

    private function normalizeData(array $data, ?User $user = null): array
    {
        $verified = (bool) ($data['is_email_verified'] ?? false);

        $data['email_verified_at'] = $verified
            ? ($user?->email_verified_at ?? now())
            : null;

        unset($data['is_email_verified']);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        return $data;
    }

    private function formData(?User $user = null): array
    {
        $user?->load('roles:id,name');

        return [
            'user' => $user,
            'roleOptions' => Role::query()->active()->orderBy('name')->get(['id', 'name', 'slug']),
        ];
    }
}
