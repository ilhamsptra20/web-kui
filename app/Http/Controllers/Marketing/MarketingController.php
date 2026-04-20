<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Lembaga; // akreditasi
use App\Models\Post;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Video;
use App\Services\SettingService;

class MarketingController extends Controller
{
    public function index(SettingService $settingService)
    {
        $marketingSettings = $settingService->only([
            'home_hero_empty_badge' => 'BERANDA KUI BELUM DIATUR',
            'home_hero_empty_title' => 'Atur Slider Beranda KUI Universitas Juanda Dari Dashboard',
            'home_hero_empty_description' => 'Tambahkan slide untuk menampilkan program unggulan, kerja sama internasional, dan informasi penting KUI Unida di halaman depan.',
            'about_subtitle' => 'TENTANG KUI',
            'about_title' => 'Membuka Akses Internasional Bagi Sivitas Akademika Universitas Juanda',
            'about_description' => 'Kantor Urusan Internasional Universitas Juanda berfokus pada pengembangan kerja sama global, mobilitas akademik, dan penguatan reputasi internasional kampus melalui program yang relevan dan berdampak.',
            'about_button_text' => 'Lihat Profil KUI',
            'about_button_url' => route('about-marketing'),
            'about_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=900&q=80',
            'about_move_text' => 'GLOBAL PARTNERSHIP, STUDENT MOBILITY, INTERNATIONAL COLLABORATION, ACADEMIC ENGAGEMENT',
            'profile_subtitle' => 'PROFIL UNIVERSITAS DJUANDA',
            'profile_title' => 'Mengenal Universitas Djuanda Sebagai Kampus Bertauhid Yang Berwawasan Global',
            'profile_description' => 'Universitas Djuanda mengembangkan pendidikan, penelitian, dan pengabdian masyarakat dengan nilai ketauhidan, kolaborasi internasional, serta komitmen untuk memberi dampak bagi bangsa dan dunia.',
            'profile_highlights' => [
                'Pendidikan berbasis nilai ketauhidan.',
                'Jejaring akademik dan kerja sama internasional.',
                'Riset dan pengabdian yang relevan dengan kebutuhan masyarakat.',
            ],
            'profile_button_text' => 'Lihat Profil Lengkap',
            'profile_button_url' => route('about-marketing'),
            'profile_empty_video_text' => 'Video profile aktif belum dipilih dari module Video.',
            'blog_subtitle' => 'BERITA & ARTIKEL',
            'blog_title' => 'Kabar, Program, Dan Peluang Internasional Terbaru',
            'blog_button_text' => 'Lihat Semua Artikel',
            'blog_button_url' => route('articles-marketing'),
            'blog_empty_title' => 'Artikel belum ditambahkan',
            'blog_empty_description' => 'Artikel, kabar kegiatan, dan informasi program internasional akan tampil otomatis setelah dipublikasikan.',
            'gallery_subtitle' => 'GALERI KUI',
            'gallery_title' => 'Potret Aktivitas Internasional Universitas Juanda',
            'gallery_button_text' => 'Lihat Semua Galeri',
            'gallery_button_url' => route('gallery-marketing'),
            'gallery_empty_description' => 'Dokumentasi kegiatan internasional belum tersedia. Tambahkan galeri melalui dashboard admin.',
            'accreditation_subtitle' => 'MITRA & JEJARING',
            'accreditation_title' => 'Kolaborasi Strategis Untuk Memperluas Jejaring Internasional',
            'accreditation_strip_label' => 'JEJARING GLOBAL',
        ]);

        // ============================================================
        // HERO SLIDER
        // ============================================================
        $heroSlides = Slider::orderBy('order')
            ->get()
            ->map(fn($s) => [
                'subtitle'    => $s->trans('subtitle'),
                'title'       => $s->trans('title'),
                'description' => $s->trans('description'),
                'btn_text'    => $s->trans('btn_text'),
                'btn_url'     => $s->btn_url,
                'image'       => $s->image,
            ]);

        // ============================================================
        // ABOUT (static / from config — tidak ada model khusus)
        // ============================================================
        $heroEmptyState = [
            'badge' => $marketingSettings['home_hero_empty_badge'],
            'title' => $marketingSettings['home_hero_empty_title'],
            'description' => $marketingSettings['home_hero_empty_description'],
        ];

        $about = [
            'description' => $marketingSettings['about_description'],
            'btn_text' => $marketingSettings['about_button_text'],
            'btn_url' => $marketingSettings['about_button_url'],
            'image' => $marketingSettings['about_image'],
            'subtitle' => $marketingSettings['about_subtitle'],
            'title' => $marketingSettings['about_title'],
            'move_text' => $marketingSettings['about_move_text'],
        ];

        $activeVideo = Video::active()->latest()->first();

        $profile = [
            'subtitle' => $marketingSettings['profile_subtitle'],
            'title' => $marketingSettings['profile_title'],
            'description' => $marketingSettings['profile_description'],
            'highlights' => is_array($marketingSettings['profile_highlights']) ? $marketingSettings['profile_highlights'] : [],
            'button_text' => $marketingSettings['profile_button_text'],
            'button_url' => $marketingSettings['profile_button_url'],
            'empty_video_text' => $marketingSettings['profile_empty_video_text'],
            'video' => $activeVideo ? [
                'title' => $activeVideo->trans('title') ?: 'Video Profile Universitas Djuanda',
                'url' => $activeVideo->video_url,
                'embed_url' => $this->resolveVideoEmbedUrl($activeVideo->video_url),
                'thumbnail_url' => Setting::resolveImageUrl($activeVideo->thumbnail),
            ] : null,
        ];

        // ============================================================
        // BLOG SECTION HEADER
        // ============================================================
        $blogSection = [
            'subtitle' => $marketingSettings['blog_subtitle'],
            'title' => $marketingSettings['blog_title'],
            'see_all_url' => $marketingSettings['blog_button_url'],
            'see_all_text' => $marketingSettings['blog_button_text'],
            'empty_title' => $marketingSettings['blog_empty_title'],
            'empty_description' => $marketingSettings['blog_empty_description'],
        ];

        // ============================================================
        // BLOG POSTS
        // Ambil post yang sudah published, beserta relasi category & user
        // ============================================================
        $blogPosts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->latest()
            ->take(4)
            ->get()
            ->map(fn($post) => [
                'image'          => $post->image,
                'category'       => $post->category?->trans('title'),
                'category_url'   => '/articles/category/' . $post->category?->slug,
                'author'         => $post->user?->name ?? 'Admin',
                'author_url'     => '/posts-by-author',
                'date'           => $post->created_at->format('d M, Y'),
                'date_url'       => '/posts-by-date',
                'title'          => $post->trans('title'),
                'url'            => '/articles/' . $post->slug,
                'read_more_text' => 'Baca Selengkapnya',
            ]);

        // ============================================================
        // GALLERY
        // Ambil semua album beserta galeri-nya (eager load)
        // ============================================================
        $galleryItems = Gallery::with('album')
            ->latest()
            ->take(6)
            ->get()
            ->map(fn($g) => [
                'image'   => $g->image,
                'caption' => $g->trans('title'),
                'url'     => route('gallery-marketing'),
            ]);

        $gallery = [
            'subtitle' => $marketingSettings['gallery_subtitle'],
            'title' => $marketingSettings['gallery_title'],
            'see_all_url' => $marketingSettings['gallery_button_url'],
            'see_all_text' => $marketingSettings['gallery_button_text'],
            'empty_description' => $marketingSettings['gallery_empty_description'],
            'items' => $galleryItems,
        ];

        // ============================================================
        // ACCREDITATION & PARTNER LEMBAGA
        // ============================================================
        $lembagaItems = Lembaga::all()
            ->map(fn($l) => [
                'logo_url'  => Setting::resolveImageUrl($l->image),
                'name'  => $l->trans('name'),
                'label' => null, // tidak ada field label di schema, sesuaikan jika ada
                'url'   => null, // tidak ada field url di schema, sesuaikan jika ada
            ]);

        $accreditation = [
            'subtitle' => $marketingSettings['accreditation_subtitle'],
            'title' => $marketingSettings['accreditation_title'],
            'strip_label' => $marketingSettings['accreditation_strip_label'],
            'items'       => $lembagaItems,
        ];

        return view('pages.marketing.index', compact(
            'heroSlides',
            'heroEmptyState',
            'about',
            'profile',
            'blogSection',
            'blogPosts',
            'gallery',
            'accreditation'
        ));
    }

    private function resolveVideoEmbedUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $path = trim((string) parse_url($url, PHP_URL_PATH), '/');

        if (! $host) {
            return null;
        }

        if (str_contains($host, 'youtube.com')) {
            parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? (str_starts_with($path, 'embed/') ? str_replace('embed/', '', $path) : null);

            return $videoId ? 'https://www.youtube.com/embed/'.$videoId : null;
        }

        if (str_contains($host, 'youtu.be')) {
            return $path !== '' ? 'https://www.youtube.com/embed/'.$path : null;
        }

        if (str_contains($host, 'vimeo.com')) {
            $videoId = collect(explode('/', $path))->filter()->last();

            return $videoId ? 'https://player.vimeo.com/video/'.$videoId : null;
        }

        return null;
    }
}
