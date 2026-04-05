<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class HomeSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('settings') || ! $this->hasBuilderColumns()) {
            return;
        }

        foreach ($this->defaults() as $item) {
            Setting::query()->firstOrCreate(
                ['key' => $item['key']],
                $item
            );
        }

        app(SettingService::class)->clearCache();
    }

    private function hasBuilderColumns(): bool
    {
        return Schema::hasColumns('settings', ['group', 'label', 'key', 'type', 'value']);
    }

    private function defaults(): array
    {
        return [
            [
                'group' => 'Brand Settings',
                'label' => 'Site Logo',
                'key' => 'site_logo',
                'type' => Setting::TYPE_IMAGE,
                'value' => '/assets/logo/unida.png',
            ],
            [
                'group' => 'Brand Settings',
                'label' => 'Site Logo Light',
                'key' => 'site_logo_light',
                'type' => Setting::TYPE_IMAGE,
                'value' => '/assets/logo/unida.png',
            ],
            [
                'group' => 'Brand Settings',
                'label' => 'Site Logo Dark',
                'key' => 'site_logo_dark',
                'type' => Setting::TYPE_IMAGE,
                'value' => '/assets/logo/unida.png',
            ],
            [
                'group' => 'Brand Settings',
                'label' => 'Footer Logo',
                'key' => 'footer_logo',
                'type' => Setting::TYPE_IMAGE,
                'value' => '/assets/logo/unida.png',
            ],
            [
                'group' => 'Brand Settings',
                'label' => 'Favicon Logo',
                'key' => 'favicon_logo',
                'type' => Setting::TYPE_IMAGE,
                'value' => '/favicon.ico',
            ],

            [
                'group' => 'Home Hero Empty State',
                'label' => 'Slider Empty Badge',
                'key' => 'home_hero_empty_badge',
                'type' => Setting::TYPE_TEXT,
                'value' => 'KONTEN SLIDER MASIH KOSONG',
            ],
            [
                'group' => 'Home Hero Empty State',
                'label' => 'Slider Empty Title',
                'key' => 'home_hero_empty_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Tambahkan Slide Hero Via Dashboard Admin',
            ],
            [
                'group' => 'Home Hero Empty State',
                'label' => 'Slider Empty Description',
                'key' => 'home_hero_empty_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Belum ada data hero slider. Silakan tambahkan melalui panel manajemen konten.',
            ],

            [
                'group' => 'About Section',
                'label' => 'About Subtitle',
                'key' => 'about_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'ABOUT US',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Title',
                'key' => 'about_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Protecting What Matters Most Through Cutting Edge Intelligence And Ethical Cyber Defense',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Description',
                'key' => 'about_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'We are a cybersecurity-first company, using AI innovation to help businesses detect threats, prevent breaches, and respond autonomously — at machine speed.',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Button Text',
                'key' => 'about_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Learn More',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Button Url',
                'key' => 'about_button_url',
                'type' => Setting::TYPE_TEXT,
                'value' => '/about',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Image',
                'key' => 'about_image',
                'type' => Setting::TYPE_IMAGE,
                'value' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&q=80',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Move Text',
                'key' => 'about_move_text',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'SMARTER PROTECTION FOR YOUR DATA, NETWORK, AND CLOUD SYSTEMS',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Highlights',
                'key' => 'about_highlights',
                'type' => Setting::TYPE_LIST,
                'value' => json_encode([
                    'Threat Detection',
                    'Breach Prevention',
                    'Autonomous Response',
                    'Ethical Cyber Defense',
                ], JSON_UNESCAPED_UNICODE),
            ],

            [
                'group' => 'Blog Section',
                'label' => 'Blog Subtitle',
                'key' => 'blog_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'BLOG & NEWS',
            ],
            [
                'group' => 'Blog Section',
                'label' => 'Blog Title',
                'key' => 'blog_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Expert Tips And Trends In Cloud Security',
            ],
            [
                'group' => 'Blog Section',
                'label' => 'Blog Button Text',
                'key' => 'blog_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'View All Articles',
            ],
            [
                'group' => 'Blog Section',
                'label' => 'Blog Button Url',
                'key' => 'blog_button_url',
                'type' => Setting::TYPE_TEXT,
                'value' => '/articles',
            ],
            [
                'group' => 'Blog Section',
                'label' => 'Blog Empty Title',
                'key' => 'blog_empty_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Artikel belum ditambahkan',
            ],
            [
                'group' => 'Blog Section',
                'label' => 'Blog Empty Description',
                'key' => 'blog_empty_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Konten artikel masih kosong dan akan tampil otomatis setelah post dipublish.',
            ],

            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Subtitle',
                'key' => 'gallery_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'OUR GALLERY',
            ],
            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Title',
                'key' => 'gallery_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'A Glimpse Into Our Security Operations Center',
            ],
            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Button Text',
                'key' => 'gallery_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'View Full Gallery',
            ],
            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Button Url',
                'key' => 'gallery_button_url',
                'type' => Setting::TYPE_TEXT,
                'value' => '/gallery',
            ],
            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Empty Description',
                'key' => 'gallery_empty_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Belum ada item galeri yang ditambahkan. Tambahkan melalui panel admin.',
            ],

            [
                'group' => 'Accreditation Section',
                'label' => 'Accreditation Subtitle',
                'key' => 'accreditation_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'ACCREDITATION & PARTNERS',
            ],
            [
                'group' => 'Accreditation Section',
                'label' => 'Accreditation Title',
                'key' => 'accreditation_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Recognized And Certified By Trusted Institutions',
            ],
            [
                'group' => 'Accreditation Section',
                'label' => 'Accreditation Strip Label',
                'key' => 'accreditation_strip_label',
                'type' => Setting::TYPE_TEXT,
                'value' => 'TRUSTED PARTNERS',
            ],

            [
                'group' => 'Footer Section',
                'label' => 'Footer Address',
                'key' => 'footer_address',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => '952 Bad Hill St, Asheville, NC 28803, USA',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Footer Email',
                'key' => 'footer_email',
                'type' => Setting::TYPE_TEXT,
                'value' => 'contact@aixio.com',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Footer Phone',
                'key' => 'footer_phone',
                'type' => Setting::TYPE_TEXT,
                'value' => '+96 76867 8869',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Newsletter Title',
                'key' => 'footer_newsletter_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Subscribe To Our Newsletter',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Newsletter Placeholder',
                'key' => 'footer_newsletter_placeholder',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Enter Your Email',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Footer Copyright',
                'key' => 'footer_copyright',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Copyright © 2026 Nabila Maulidia. All Rights Reserved.',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Footer Social Labels',
                'key' => 'footer_social_labels',
                'type' => Setting::TYPE_LIST,
                'value' => json_encode([
                    'Facebook',
                    'X',
                    'Instagram',
                    'LinkedIn',
                ], JSON_UNESCAPED_UNICODE),
            ],

            [
                'group' => 'Layout Settings',
                'label' => 'Primary Contact Button Text',
                'key' => 'primary_contact_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Get In Touch',
            ],
            [
                'group' => 'Layout Settings',
                'label' => 'Primary Contact Button Url',
                'key' => 'primary_contact_button_url',
                'type' => Setting::TYPE_TEXT,
                'value' => '/contact',
            ],
            [
                'group' => 'Layout Settings',
                'label' => 'Default Locale Options',
                'key' => 'default_locale_options',
                'type' => Setting::TYPE_LIST,
                'value' => json_encode([
                    'ID',
                    'EN',
                    'AR',
                ], JSON_UNESCAPED_UNICODE),
            ],
        ];
    }
}
