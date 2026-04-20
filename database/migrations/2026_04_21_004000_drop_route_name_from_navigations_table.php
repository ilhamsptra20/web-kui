<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('navigations') || ! Schema::hasColumn('navigations', 'route_name')) {
            return;
        }

        if (Schema::hasColumn('navigations', 'url')) {
            $routeUrls = [
                'about-marketing' => '/about',
                'events-marketing' => '/events',
                'teams-marketing' => '/team',
                'announcements-marketing' => '/announcement',
                'gallery-marketing' => '/gallery',
                'articles-marketing' => '/articles',
                'contact-marketing' => '/contact',
            ];

            foreach ($routeUrls as $routeName => $url) {
                DB::table('navigations')
                    ->where('route_name', $routeName)
                    ->where(function ($query): void {
                        $query->whereNull('url')->orWhere('url', '');
                    })
                    ->update(['url' => $url]);
            }

            DB::table('navigations')
                ->whereNotNull('route_name')
                ->where(function ($query): void {
                    $query->whereNull('url')->orWhere('url', '');
                })
                ->update(['url' => '#']);
        }

        Schema::table('navigations', function (Blueprint $table): void {
            $table->dropColumn('route_name');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('navigations') || Schema::hasColumn('navigations', 'route_name')) {
            return;
        }

        Schema::table('navigations', function (Blueprint $table): void {
            $table->string('route_name')->nullable()->after('url');
        });
    }
};
