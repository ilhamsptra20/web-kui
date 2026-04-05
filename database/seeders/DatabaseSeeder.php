<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@email.com',
        ], [
            'name' => 'admin',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $this->call([
            RolePermissionSeeder::class,
            NavigationSeeder::class,
            HomeSettingSeeder::class,
        ]);

        if (app()->environment(['local', 'development'])) {
            $this->call([
                KuiUnidaDemoSeeder::class,
            ]);
        }
    }
}
