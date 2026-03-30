<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Post;
use App\Models\Category;
use App\Models\Album;
use App\Models\Gallery;
use App\Models\Lembaga; // akreditasi

class MarketingController extends Controller
{
    public function index()
    {
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
        $about = [
            'description' => 'We are a cybersecurity-first company, using AI innovation to help businesses detect threats, prevent breaches, and respond autonomously — at machine speed.',
            'btn_text'    => 'Learn More',
            'btn_url'     => '/about-us',
            'image'       => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&q=80',
            'subtitle'    => 'ABOUT US',
            'title'       => 'Protecting What Matters Most Through Cutting Edge Intelligence And Ethical Cyber Defense',
            'move_text'   => 'SMARTER PROTECTION FOR YOUR DATA, NETWORK, AND CLOUD SYSTEMS',
        ];

        // ============================================================
        // BLOG SECTION HEADER
        // ============================================================
        $blogSection = [
            'subtitle'     => 'BLOG & NEWS',
            'title'        => 'Expert Tips And Trends In Cloud Security',
            'see_all_url'  => '/blog',
            'see_all_text' => 'View All Articles',
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
                'category_url'   => '/blog/category/' . $post->category?->slug,
                'author'         => $post->user?->name ?? 'Admin',
                'author_url'     => '/posts-by-author',
                'date'           => $post->created_at->format('d M, Y'),
                'date_url'       => '/posts-by-date',
                'title'          => $post->trans('title'),
                'url'            => '/blog/' . $post->slug,
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
                'url'     => '/gallery/' . $g->album?->slug,
            ]);

        $gallery = [
            'subtitle'     => 'OUR GALLERY',
            'title'        => 'A Glimpse Into Our Security Operations Center',
            'see_all_url'  => '/gallery',
            'see_all_text' => 'View Full Gallery',
            'items'        => $galleryItems,
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
            'subtitle'    => 'AKREDITASI & LEMBAGA',
            'title'       => 'Diakui Dan Tersertifikasi Oleh Lembaga Terpercaya',
            'strip_label' => 'Tersertifikasi',
            'items'       => $lembagaItems,
        ];

        return view('pages.marketing.index', compact(
            'heroSlides',
            'about',
            'blogSection',
            'blogPosts',
            'gallery',
            'accreditation'
        ));
    }
}