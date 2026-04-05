<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect([
            ['name' => 'Dashboard View', 'slug' => 'dashboard.view', 'group' => 'system', 'description' => 'Akses dashboard admin'],
            ['name' => 'Users Manage', 'slug' => 'user.manage', 'group' => 'system', 'description' => 'Kelola akun user'],
            ['name' => 'Roles Manage', 'slug' => 'role.manage', 'group' => 'system', 'description' => 'Kelola role'],
            ['name' => 'Permissions Manage', 'slug' => 'permission.manage', 'group' => 'system', 'description' => 'Kelola permission'],
            ['name' => 'Navigation Manage', 'slug' => 'navigation.manage', 'group' => 'system', 'description' => 'Kelola navigasi'],
            ['name' => 'Settings Manage', 'slug' => 'setting.manage', 'group' => 'system', 'description' => 'Kelola setting'],
            ['name' => 'Social Media Manage', 'slug' => 'social_media.manage', 'group' => 'system', 'description' => 'Kelola social media'],
            ['name' => 'Category Manage', 'slug' => 'category.manage', 'group' => 'content', 'description' => 'Kelola kategori'],
            ['name' => 'Post Manage', 'slug' => 'post.manage', 'group' => 'content', 'description' => 'Kelola post'],
            ['name' => 'Page Manage', 'slug' => 'page.manage', 'group' => 'content', 'description' => 'Kelola page'],
            ['name' => 'Album Manage', 'slug' => 'album.manage', 'group' => 'media', 'description' => 'Kelola album'],
            ['name' => 'Gallery Manage', 'slug' => 'gallery.manage', 'group' => 'media', 'description' => 'Kelola gallery'],
            ['name' => 'Video Manage', 'slug' => 'video.manage', 'group' => 'media', 'description' => 'Kelola video'],
            ['name' => 'Slider Manage', 'slug' => 'slider.manage', 'group' => 'media', 'description' => 'Kelola slider'],
            ['name' => 'Agenda Manage', 'slug' => 'agenda.manage', 'group' => 'information', 'description' => 'Kelola agenda'],
            ['name' => 'Announcement Manage', 'slug' => 'announcement.manage', 'group' => 'information', 'description' => 'Kelola announcement'],
            ['name' => 'Inbox Manage', 'slug' => 'inbox.manage', 'group' => 'information', 'description' => 'Kelola inbox'],
            ['name' => 'Lembaga Manage', 'slug' => 'lembaga.manage', 'group' => 'information', 'description' => 'Kelola lembaga'],
            ['name' => 'Position Manage', 'slug' => 'position.manage', 'group' => 'team', 'description' => 'Kelola position'],
            ['name' => 'Team Manage', 'slug' => 'team.manage', 'group' => 'team', 'description' => 'Kelola team'],
        ])->map(function (array $permission): Permission {
            return Permission::query()->updateOrCreate(
                ['slug' => $permission['slug']],
                array_merge($permission, ['is_active' => true])
            );
        });

        $roles = [
            'super-admin' => [
                'name' => 'Super Admin',
                'description' => 'Akses penuh ke seluruh panel admin',
                'permissions' => $permissions->pluck('id')->all(),
            ],
            'content-manager' => [
                'name' => 'Content Manager',
                'description' => 'Kelola konten, media, dan informasi publik',
                'permissions' => Permission::query()
                    ->whereIn('slug', [
                        'dashboard.view',
                        'category.manage',
                        'post.manage',
                        'page.manage',
                        'album.manage',
                        'gallery.manage',
                        'video.manage',
                        'slider.manage',
                        'agenda.manage',
                        'announcement.manage',
                        'lembaga.manage',
                    ])->pluck('id')->all(),
            ],
            'operator' => [
                'name' => 'Operator',
                'description' => 'Kelola inbox, tim, dan update informasi operasional',
                'permissions' => Permission::query()
                    ->whereIn('slug', [
                        'dashboard.view',
                        'inbox.manage',
                        'agenda.manage',
                        'announcement.manage',
                        'position.manage',
                        'team.manage',
                    ])->pluck('id')->all(),
            ],
        ];

        foreach ($roles as $slug => $roleData) {
            $role = Role::query()->updateOrCreate(
                ['slug' => $slug],
                Arr::except(array_merge($roleData, ['slug' => $slug, 'is_active' => true]), ['permissions'])
            );

            $role->permissions()->sync($roleData['permissions']);
        }

        $adminUser = User::query()->where('email', 'admin@email.com')->first()
            ?? User::query()->oldest('id')->first();

        if ($adminUser) {
            $superAdmin = Role::query()->where('slug', 'super-admin')->first();
            if ($superAdmin) {
                $adminUser->roles()->syncWithoutDetaching([$superAdmin->id]);
            }
        }
    }
}
