<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class MarketingPagesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('The pdo_sqlite extension is required for feature tests.');
        }

        Artisan::call('migrate:fresh');
    }

    public static function publicPageProvider(): array
    {
        return [
            'about page' => ['/about'],
            'articles page' => ['/articles'],
            'announcements page' => ['/announcement'],
            'events page' => ['/events'],
            'gallery page' => ['/gallery'],
            'contact page' => ['/contact'],
        ];
    }

    #[DataProvider('publicPageProvider')]
    public function test_public_marketing_pages_render_successfully(string $uri): void
    {
        $this->get($uri)->assertOk();
    }
}
