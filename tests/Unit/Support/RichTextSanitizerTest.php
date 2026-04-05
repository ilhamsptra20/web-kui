<?php

namespace Tests\Unit\Support;

use App\Support\RichText\RichTextSanitizer;
use PHPUnit\Framework\TestCase;

class RichTextSanitizerTest extends TestCase
{
    public function test_it_keeps_allowed_markup(): void
    {
        $sanitizer = new RichTextSanitizer();
        $html = '<h2>Judul</h2><p><strong>Halo</strong> <em>dunia</em></p><ul><li>Item</li></ul>';

        $sanitized = $sanitizer->sanitize($html);

        $this->assertStringContainsString('<h2>Judul</h2>', $sanitized);
        $this->assertStringContainsString('<strong>Halo</strong>', $sanitized);
        $this->assertStringContainsString('<ul><li>Item</li></ul>', $sanitized);
    }

    public function test_it_removes_scripts_and_unsafe_attributes(): void
    {
        $sanitizer = new RichTextSanitizer();
        $html = '<p onclick="alert(1)">Tes</p><script>alert(1)</script><a href="javascript:alert(1)">klik</a>';

        $sanitized = $sanitizer->sanitize($html);

        $this->assertStringNotContainsString('<script>', $sanitized);
        $this->assertStringNotContainsString('onclick=', $sanitized);
        $this->assertStringNotContainsString('javascript:', $sanitized);
        $this->assertStringContainsString('<p>Tes</p>', $sanitized);
    }
}
