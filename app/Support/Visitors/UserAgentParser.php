<?php

namespace App\Support\Visitors;

class UserAgentParser
{
    /**
     * @return array{
     *     browser_name: string,
     *     browser_version: ?string,
     *     os_name: string,
     *     os_version: ?string,
     *     device_type: string,
     *     is_bot: bool
     * }
     */
    public function parse(?string $userAgent): array
    {
        $userAgent = trim((string) $userAgent);

        if ($userAgent === '') {
            return [
                'browser_name' => 'Unknown',
                'browser_version' => null,
                'os_name' => 'Unknown',
                'os_version' => null,
                'device_type' => 'other',
                'is_bot' => false,
            ];
        }

        $isBot = $this->isBot($userAgent);
        $browser = $this->detectBrowser($userAgent);
        $os = $this->detectOperatingSystem($userAgent);

        return [
            'browser_name' => $browser['name'],
            'browser_version' => $browser['version'],
            'os_name' => $os['name'],
            'os_version' => $os['version'],
            'device_type' => $this->detectDeviceType($userAgent, $isBot),
            'is_bot' => $isBot,
        ];
    }

    private function isBot(string $userAgent): bool
    {
        return (bool) preg_match(
            '/bot|crawler|spider|slurp|bingpreview|mediapartners-google|googleother|apis-google|adsbot|facebookexternalhit/i',
            $userAgent
        );
    }

    /**
     * @return array{name: string, version: ?string}
     */
    private function detectBrowser(string $userAgent): array
    {
        $patterns = [
            'Googlebot' => '/Googlebot\/([\d\.]+)/i',
            'Bingbot' => '/bingbot\/([\d\.]+)/i',
            'Opera' => '/(?:OPR|Opera)\/([\d\.]+)/i',
            'Edge' => '/Edg(?:A|iOS)?\/([\d\.]+)/i',
            'Chrome' => '/(?:Chrome|CriOS)\/([\d\.]+)/i',
            'Firefox' => '/(?:Firefox|FxiOS)\/([\d\.]+)/i',
            'Safari' => '/Version\/([\d\.]+).+Safari/i',
            'Internet Explorer' => '/(?:MSIE\s|rv:)([\d\.]+)/i',
        ];

        foreach ($patterns as $name => $pattern) {
            if (preg_match($pattern, $userAgent, $matches) === 1) {
                return [
                    'name' => $name,
                    'version' => $matches[1] ?? null,
                ];
            }
        }

        return [
            'name' => 'Other',
            'version' => null,
        ];
    }

    /**
     * @return array{name: string, version: ?string}
     */
    private function detectOperatingSystem(string $userAgent): array
    {
        if (preg_match('/Windows NT 10\.0/i', $userAgent) === 1) {
            return ['name' => 'Windows', 'version' => '10/11'];
        }

        if (preg_match('/Windows NT 6\.3/i', $userAgent) === 1) {
            return ['name' => 'Windows', 'version' => '8.1'];
        }

        if (preg_match('/Windows NT 6\.2/i', $userAgent) === 1) {
            return ['name' => 'Windows', 'version' => '8'];
        }

        if (preg_match('/Windows NT 6\.1/i', $userAgent) === 1) {
            return ['name' => 'Windows', 'version' => '7'];
        }

        if (preg_match('/iPad; CPU OS ([\d_]+)/i', $userAgent, $matches) === 1) {
            return ['name' => 'iPadOS', 'version' => str_replace('_', '.', $matches[1])];
        }

        if (preg_match('/(?:iPhone|CPU iPhone OS|CPU OS) ([\d_]+)/i', $userAgent, $matches) === 1) {
            return ['name' => 'iOS', 'version' => str_replace('_', '.', $matches[1])];
        }

        if (preg_match('/Android ([\d\.]+)/i', $userAgent, $matches) === 1) {
            return ['name' => 'Android', 'version' => $matches[1]];
        }

        if (preg_match('/CrOS/i', $userAgent) === 1) {
            return ['name' => 'Chrome OS', 'version' => null];
        }

        if (preg_match('/Mac OS X ([\d_]+)/i', $userAgent, $matches) === 1) {
            return ['name' => 'macOS', 'version' => str_replace('_', '.', $matches[1])];
        }

        if (preg_match('/Linux/i', $userAgent) === 1) {
            return ['name' => 'Linux', 'version' => null];
        }

        return ['name' => 'Unknown', 'version' => null];
    }

    private function detectDeviceType(string $userAgent, bool $isBot): string
    {
        if ($isBot) {
            return 'bot';
        }

        if (preg_match('/iPad|Tablet|PlayBook|Silk/i', $userAgent) === 1) {
            return 'tablet';
        }

        if (preg_match('/Mobile|iPhone|Android/i', $userAgent) === 1) {
            return 'mobile';
        }

        if (preg_match('/Windows|Macintosh|Linux|CrOS/i', $userAgent) === 1) {
            return 'desktop';
        }

        return 'other';
    }
}
