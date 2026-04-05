<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function permissions(): Collection
    {
        return Permission::query()
            ->where('is_active', true)
            ->whereIn('id', $this->roles()->active()->with(['permissions' => fn ($query) => $query->where('is_active', true)->select('permissions.id')])->get()->flatMap->permissions->pluck('id')->unique())
            ->get();
    }

    public function hasRole(string|array $roles): bool
    {
        $roles = is_array($roles) ? $roles : explode('|', $roles);

        return $this->roles()
            ->where('is_active', true)
            ->where(function ($query) use ($roles): void {
                $query->whereIn('slug', $roles)
                    ->orWhereIn('name', $roles);
            })
            ->exists();
    }

    public function hasPermission(string|array $permissions): bool
    {
        $permissions = is_array($permissions) ? $permissions : explode('|', $permissions);

        return $this->roles()
            ->where('roles.is_active', true)
            ->whereHas('permissions', function ($query) use ($permissions): void {
                $query->where('permissions.is_active', true)
                    ->where(function ($permissionQuery) use ($permissions): void {
                        $permissionQuery->whereIn('permissions.slug', $permissions)
                            ->orWhereIn('permissions.name', $permissions);
                    });
            })
            ->exists();
    }

    public function syncRoles(array $roleIds): void
    {
        $this->roles()->sync($roleIds);
    }
}
