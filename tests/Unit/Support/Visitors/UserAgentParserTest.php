<?php

namespace Tests\Unit\Support\Visitors;

use App\Support\Visitors\UserAgentParser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class UserAgentParserTest extends TestCase
{
    public static function userAgentProvider(): array
    {
        return [
            'chrome on windows' => [
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
                'Chrome',
                'Windows',
                'desktop',
                false,
            ],
            'firefox on linux' => [
                'Mozilla/5.0 (X11; Linux x86_64; rv:124.0) Gecko/20100101 Firefox/124.0',
                'Firefox',
                'Linux',
                'desktop',
                false,
            ],
            'safari on ios' => [
                'Mozilla/5.0 (iPhone; CPU iPhone OS 17_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Mobile/15E148 Safari/604.1',
                'Safari',
                'iOS',
                'mobile',
                false,
            ],
            'googlebot' => [
                'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                'Googlebot',
                'Unknown',
                'bot',
                true,
            ],
        ];
    }

    #[DataProvider('userAgentProvider')]
    public function test_it_detects_browser_os_and_device_type(
        string $userAgent,
        string $browser,
        string $os,
        string $deviceType,
        bool $isBot
    ): void {
        $result = (new UserAgentParser())->parse($userAgent);

        $this->assertSame($browser, $result['browser_name']);
        $this->assertSame($os, $result['os_name']);
        $this->assertSame($deviceType, $result['device_type']);
        $this->assertSame($isBot, $result['is_bot']);
    }
}
