<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Lembaga; // akreditasi
use App\Models\Post;
use App\Models\Slider;
use App\Services\SettingService;

class MarketingController extends Controller
{
    public function index(SettingService $settingService)
    {
        $marketingSettings = $settingService->only([
            'home_hero_empty_badge' => 'KONTEN SLIDER MASIH KOSONG',
            'home_hero_empty_title' => 'Tambahkan Slide Hero Via Dashboard Admin',
            'home_hero_empty_description' => 'Belum ada data hero slider. Silakan tambahkan melalui panel manajemen konten.',
            'about_subtitle' => 'ABOUT US',
            'about_title' => 'Protecting What Matters Most Through Cutting Edge Intelligence And Ethical Cyber Defense',
            'about_description' => 'We are a cybersecurity-first company, using AI innovation to help businesses detect threats, prevent breaches, and respond autonomously — at machine speed.',
            'about_button_text' => 'Learn More',
            'about_button_url' => route('about-marketing'),
            'about_image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&q=80',
            'about_move_text' => 'SMARTER PROTECTION FOR YOUR DATA, NETWORK, AND CLOUD SYSTEMS',
            'blog_subtitle' => 'BLOG & NEWS',
            'blog_title' => 'Expert Tips And Trends In Cloud Security',
            'blog_button_text' => 'View All Articles',
            'blog_button_url' => route('articles-marketing'),
            'blog_empty_title' => 'Artikel belum ditambahkan',
            'blog_empty_description' => 'Konten artikel masih kosong dan akan tampil otomatis setelah post dipublish.',
            'gallery_subtitle' => 'OUR GALLERY',
            'gallery_title' => 'A Glimpse Into Our Security Operations Center',
            'gallery_button_text' => 'View Full Gallery',
            'gallery_button_url' => route('gallery-marketing'),
            'gallery_empty_description' => 'Belum ada item galeri yang ditambahkan. Tambahkan melalui panel admin.',
            'accreditation_subtitle' => 'ACCREDITATION & PARTNERS',
            'accreditation_title' => 'Recognized And Certified By Trusted Institutions',
            'accreditation_strip_label' => 'TRUSTED PARTNERS',
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
                'read_more_text' => 'Read More',
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
                'logo'  => $l->image,
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
            'blogSection',
            'blogPosts',
            'gallery',
            'accreditation'
        ));
    }
}
