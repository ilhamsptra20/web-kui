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
            $setting = Setting::query()->where('key', $item['key'])->first();

            if (! $setting) {
                Setting::query()->create($item);

                continue;
            }

            if ($this->shouldRefreshDefault($setting, $item)) {
                $setting->fill($item);
                $setting->save();

                continue;
            }

            $dirty = false;

            foreach (['group', 'label', 'type'] as $field) {
                if (blank($setting->{$field})) {
                    $setting->{$field} = $item[$field];
                    $dirty = true;
                }
            }

            if ($dirty) {
                $setting->save();
            }
        }

        app(SettingService::class)->clearCache();
    }

    private function hasBuilderColumns(): bool
    {
        return Schema::hasColumns('settings', ['group', 'label', 'key', 'type', 'value']);
    }

    private function shouldRefreshDefault(Setting $setting, array $item): bool
    {
        if (blank($setting->value)) {
            return true;
        }

        return in_array((string) $setting->value, $this->legacyValues()[$setting->key] ?? [], true);
    }

    private function legacyValues(): array
    {
        return [
            'home_hero_empty_badge' => [
                'KONTEN SLIDER MASIH KOSONG',
            ],
            'home_hero_empty_title' => [
                'Tambahkan Slide Hero Via Dashboard Admin',
            ],
            'home_hero_empty_description' => [
                'Belum ada data hero slider. Silakan tambahkan melalui panel manajemen konten.',
            ],
            'about_subtitle' => [
                'ABOUT US',
            ],
            'about_title' => [
                'Protecting What Matters Most Through Cutting Edge Intelligence And Ethical Cyber Defense',
            ],
            'about_description' => [
                'We are a cybersecurity-first company, using AI innovation to help businesses detect threats, prevent breaches, and respond autonomously — at machine speed.',
            ],
            'about_button_text' => [
                'Learn More',
            ],
            'about_image' => [
                'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&q=80',
            ],
            'about_move_text' => [
                'SMARTER PROTECTION FOR YOUR DATA, NETWORK, AND CLOUD SYSTEMS',
            ],
            'about_highlights' => [
                json_encode([
                    'Threat Detection',
                    'Breach Prevention',
                    'Autonomous Response',
                    'Ethical Cyber Defense',
                ], JSON_UNESCAPED_UNICODE),
            ],
            'blog_subtitle' => [
                'BLOG & NEWS',
            ],
            'blog_title' => [
                'Expert Tips And Trends In Cloud Security',
            ],
            'blog_button_text' => [
                'View All Articles',
            ],
            'blog_empty_description' => [
                'Konten artikel masih kosong dan akan tampil otomatis setelah post dipublish.',
            ],
            'gallery_subtitle' => [
                'OUR GALLERY',
            ],
            'gallery_title' => [
                'A Glimpse Into Our Security Operations Center',
            ],
            'gallery_button_text' => [
                'View Full Gallery',
            ],
            'gallery_empty_description' => [
                'Belum ada item galeri yang ditambahkan. Tambahkan melalui panel admin.',
            ],
            'accreditation_subtitle' => [
                'ACCREDITATION & PARTNERS',
            ],
            'accreditation_title' => [
                'Recognized And Certified By Trusted Institutions',
            ],
            'accreditation_strip_label' => [
                'TRUSTED PARTNERS',
            ],
            'primary_contact_button_text' => [
                'Get In Touch',
            ],
        ];
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
                'value' => 'BERANDA KUI BELUM DIATUR',
            ],
            [
                'group' => 'Home Hero Empty State',
                'label' => 'Slider Empty Title',
                'key' => 'home_hero_empty_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Atur Slider Beranda KUI Universitas Juanda Dari Dashboard',
            ],
            [
                'group' => 'Home Hero Empty State',
                'label' => 'Slider Empty Description',
                'key' => 'home_hero_empty_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Tambahkan slide untuk menampilkan program unggulan, kerja sama internasional, dan informasi penting KUI Unida di halaman depan.',
            ],

            [
                'group' => 'About Section',
                'label' => 'About Subtitle',
                'key' => 'about_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'TENTANG KUI',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Title',
                'key' => 'about_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Membuka Akses Internasional Bagi Sivitas Akademika Universitas Juanda',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Description',
                'key' => 'about_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Kantor Urusan Internasional Universitas Juanda berfokus pada pengembangan kerja sama global, mobilitas akademik, dan penguatan reputasi internasional kampus melalui program yang relevan dan berdampak.',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Button Text',
                'key' => 'about_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Lihat Profil KUI',
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
                'value' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=900&q=80',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Move Text',
                'key' => 'about_move_text',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'GLOBAL PARTNERSHIP, STUDENT MOBILITY, INTERNATIONAL COLLABORATION, ACADEMIC ENGAGEMENT',
            ],
            [
                'group' => 'About Section',
                'label' => 'About Highlights',
                'key' => 'about_highlights',
                'type' => Setting::TYPE_LIST,
                'value' => json_encode([
                    'Kemitraan internasional strategis',
                    'Program inbound dan outbound mobility',
                    'Pendampingan akademik lintas negara',
                    'Promosi global Universitas Juanda',
                ], JSON_UNESCAPED_UNICODE),
            ],

            [
                'group' => 'About Page',
                'label' => 'About Page Subtitle',
                'key' => 'about_page_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'PROFILE KUI UNIDA',
            ],
            [
                'group' => 'About Page',
                'label' => 'About Page Title',
                'key' => 'about_page_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Mendorong Internasionalisasi Universitas Juanda Melalui Kolaborasi Global Yang Relevan',
            ],
            [
                'group' => 'About Page',
                'label' => 'About Page Lead',
                'key' => 'about_page_lead',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Kantor Urusan Internasional Universitas Juanda hadir untuk memperluas jejaring global, mendukung mobilitas akademik, dan memperkuat ekosistem kampus yang terbuka, kolaboratif, dan berdaya saing internasional.',
            ],
            [
                'group' => 'About Page',
                'label' => 'About Page Intro Title',
                'key' => 'about_page_intro_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Tentang Kantor Urusan Internasional Universitas Juanda',
            ],
            [
                'group' => 'About Page',
                'label' => 'About Page Intro Description',
                'key' => 'about_page_intro_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'KUI Unida berperan sebagai penghubung utama antara Universitas Juanda dengan mitra internasional, mahasiswa asing, program pertukaran, serta berbagai inisiatif kolaborasi lintas negara. Fokus kami adalah menghadirkan pengalaman internasional yang nyata, terukur, dan berdampak bagi sivitas akademika.',
            ],
            [
                'group' => 'About Page',
                'label' => 'About Page Image',
                'key' => 'about_page_image',
                'type' => Setting::TYPE_IMAGE,
                'value' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
            ],
            [
                'group' => 'About Page',
                'label' => 'Mission Title',
                'key' => 'about_page_mission_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Misi KUI Unida',
            ],
            [
                'group' => 'About Page',
                'label' => 'Mission Description',
                'key' => 'about_page_mission_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Mengembangkan layanan internasional yang terintegrasi untuk mendukung kerja sama global, pertukaran akademik, promosi kampus, dan penguatan kapasitas internasional seluruh unit di Universitas Juanda.',
            ],
            [
                'group' => 'About Page',
                'label' => 'Vision Title',
                'key' => 'about_page_vision_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Visi KUI Unida',
            ],
            [
                'group' => 'About Page',
                'label' => 'Vision Description',
                'key' => 'about_page_vision_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Menjadi pusat layanan internasional universitas yang profesional, adaptif, dan strategis dalam memperluas reputasi global Universitas Juanda.',
            ],
            [
                'group' => 'About Page',
                'label' => 'Values Title',
                'key' => 'about_page_values_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Nilai Utama',
            ],
            [
                'group' => 'About Page',
                'label' => 'Values',
                'key' => 'about_page_values',
                'type' => Setting::TYPE_LIST,
                'value' => json_encode([
                    'Kolaboratif dalam membangun kemitraan internasional yang berkelanjutan.',
                    'Responsif terhadap kebutuhan mahasiswa, dosen, dan mitra global.',
                    'Profesional dalam pengelolaan layanan akademik lintas negara.',
                    'Inklusif dalam mendukung lingkungan kampus multikultural.',
                ], JSON_UNESCAPED_UNICODE),
            ],
            [
                'group' => 'About Page',
                'label' => 'Programs Title',
                'key' => 'about_page_programs_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Fokus Layanan',
            ],
            [
                'group' => 'About Page',
                'label' => 'Programs',
                'key' => 'about_page_programs',
                'type' => Setting::TYPE_LIST,
                'value' => json_encode([
                    'Pengembangan kerja sama internasional universitas.',
                    'Pendampingan program inbound dan outbound mobility.',
                    'Promosi kampus kepada calon mitra dan mahasiswa internasional.',
                    'Layanan administrasi dasar untuk aktivitas akademik internasional.',
                    'Penguatan branding global Universitas Juanda.',
                ], JSON_UNESCAPED_UNICODE),
            ],
            [
                'group' => 'About Page',
                'label' => 'CTA Title',
                'key' => 'about_page_cta_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Siap Berkolaborasi Dengan KUI Unida',
            ],
            [
                'group' => 'About Page',
                'label' => 'CTA Description',
                'key' => 'about_page_cta_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Hubungi kami untuk menjajaki kerja sama, program mobilitas, kunjungan akademik, atau inisiatif internasional lainnya bersama Universitas Juanda.',
            ],
            [
                'group' => 'About Page',
                'label' => 'CTA Button Text',
                'key' => 'about_page_cta_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Hubungi KUI',
            ],
            [
                'group' => 'About Page',
                'label' => 'CTA Button Url',
                'key' => 'about_page_cta_button_url',
                'type' => Setting::TYPE_TEXT,
                'value' => '/contact',
            ],

            [
                'group' => 'Contact Page',
                'label' => 'Contact Page Subtitle',
                'key' => 'contact_page_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'HUBUNGI KUI UNIDA',
            ],
            [
                'group' => 'Contact Page',
                'label' => 'Contact Page Title',
                'key' => 'contact_page_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Mari Bangun Kolaborasi Internasional Bersama Kantor Urusan Internasional Universitas Juanda',
            ],
            [
                'group' => 'Contact Page',
                'label' => 'Contact Page Description',
                'key' => 'contact_page_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'KUI Unida terbuka untuk komunikasi terkait kerja sama internasional, mobilitas mahasiswa, visiting lecture, program akademik global, dan kebutuhan informasi internasional lainnya.',
            ],
            [
                'group' => 'Contact Page',
                'label' => 'Contact Card Title',
                'key' => 'contact_page_card_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Kantor Urusan Internasional',
            ],
            [
                'group' => 'Contact Page',
                'label' => 'Contact Response Note',
                'key' => 'contact_page_response_note',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Tim kami akan merespons pertanyaan dan usulan kerja sama secepat mungkin pada jam kerja.',
            ],
            [
                'group' => 'Contact Page',
                'label' => 'Contact Hours Title',
                'key' => 'contact_page_hours_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Jam Layanan',
            ],
            [
                'group' => 'Contact Page',
                'label' => 'Contact Hours Value',
                'key' => 'contact_page_hours_value',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Senin - Jumat, 08.00 - 16.00 WIB',
            ],
            [
                'group' => 'Contact Page',
                'label' => 'Contact Map Embed Url',
                'key' => 'contact_page_map_embed_url',
                'type' => Setting::TYPE_TEXT,
                'value' => '',
            ],

            [
                'group' => 'Team Page',
                'label' => 'Team Page Subtitle',
                'key' => 'team_page_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'TIM KUI UNIDA',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page Title',
                'key' => 'team_page_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Tim KUI Universitas Juanda Yang Mendukung Jejaring Dan Layanan Internasional Kampus',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page Description',
                'key' => 'team_page_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Kenali tim Kantor Urusan Internasional Universitas Juanda yang berperan dalam pengelolaan kerja sama global, mobilitas akademik, komunikasi internasional, dan dukungan layanan untuk sivitas akademika.',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page Highlight Title',
                'key' => 'team_page_highlight_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Kolaboratif, Responsif, Dan Siap Mendampingi Program Internasional',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page Highlight Description',
                'key' => 'team_page_highlight_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Setiap anggota tim KUI Unida hadir untuk memastikan proses komunikasi, fasilitasi, dan koordinasi internasional berjalan lebih terarah dan profesional.',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page CTA Title',
                'key' => 'team_page_cta_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Butuh Dukungan Atau Ingin Berkolaborasi Dengan Tim KUI?',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page CTA Description',
                'key' => 'team_page_cta_description',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Hubungi kami untuk keperluan kerja sama internasional, mobilitas mahasiswa, promosi kampus, atau koordinasi kunjungan akademik.',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page CTA Button Text',
                'key' => 'team_page_cta_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Hubungi KUI',
            ],
            [
                'group' => 'Team Page',
                'label' => 'Team Page CTA Button Url',
                'key' => 'team_page_cta_button_url',
                'type' => Setting::TYPE_TEXT,
                'value' => '/contact',
            ],

            [
                'group' => 'Blog Section',
                'label' => 'Blog Subtitle',
                'key' => 'blog_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'BERITA & ARTIKEL',
            ],
            [
                'group' => 'Blog Section',
                'label' => 'Blog Title',
                'key' => 'blog_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Kabar, Program, Dan Peluang Internasional Terbaru',
            ],
            [
                'group' => 'Blog Section',
                'label' => 'Blog Button Text',
                'key' => 'blog_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Lihat Semua Artikel',
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
                'value' => 'Artikel, kabar kegiatan, dan informasi program internasional akan tampil otomatis setelah dipublikasikan.',
            ],

            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Subtitle',
                'key' => 'gallery_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'GALERI KUI',
            ],
            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Title',
                'key' => 'gallery_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Potret Aktivitas Internasional Universitas Juanda',
            ],
            [
                'group' => 'Gallery Section',
                'label' => 'Gallery Button Text',
                'key' => 'gallery_button_text',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Lihat Semua Galeri',
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
                'value' => 'Dokumentasi kegiatan internasional belum tersedia. Tambahkan galeri melalui dashboard admin.',
            ],

            [
                'group' => 'Accreditation Section',
                'label' => 'Accreditation Subtitle',
                'key' => 'accreditation_subtitle',
                'type' => Setting::TYPE_TEXT,
                'value' => 'MITRA & JEJARING',
            ],
            [
                'group' => 'Accreditation Section',
                'label' => 'Accreditation Title',
                'key' => 'accreditation_title',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Kolaborasi Strategis Untuk Memperluas Jejaring Internasional',
            ],
            [
                'group' => 'Accreditation Section',
                'label' => 'Accreditation Strip Label',
                'key' => 'accreditation_strip_label',
                'type' => Setting::TYPE_TEXT,
                'value' => 'JEJARING GLOBAL',
            ],

            [
                'group' => 'Footer Section',
                'label' => 'Footer Address',
                'key' => 'footer_address',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Kampus Universitas Juanda, Ciawi, Bogor, Jawa Barat, Indonesia',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Footer Email',
                'key' => 'footer_email',
                'type' => Setting::TYPE_TEXT,
                'value' => 'kui@unida.ac.id',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Footer Phone',
                'key' => 'footer_phone',
                'type' => Setting::TYPE_TEXT,
                'value' => '+62 251 8246475',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Newsletter Title',
                'key' => 'footer_newsletter_title',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Informasi & Update KUI',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Newsletter Placeholder',
                'key' => 'footer_newsletter_placeholder',
                'type' => Setting::TYPE_TEXT,
                'value' => 'Masukkan email Anda',
            ],
            [
                'group' => 'Footer Section',
                'label' => 'Footer Copyright',
                'key' => 'footer_copyright',
                'type' => Setting::TYPE_LONGTEXT,
                'value' => 'Copyright © 2026 KUI Universitas Juanda. All Rights Reserved.',
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
                'value' => 'Hubungi KUI',
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
