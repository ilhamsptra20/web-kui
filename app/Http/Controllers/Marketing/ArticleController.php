<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    const PER_PAGE = 6;

    public function index(Request $request)
    {
        // ============================================================
        // BREADCRUMB
        // ============================================================
        $breadcrumb = [
            'title' => 'Blog',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'BLOG', 'url' => null],
            ],
        ];

        // ============================================================
        // SIDEBAR — CATEGORIES
        // Ambil semua category beserta jumlah post published-nya
        // ============================================================
        $categories = Category::withCount(['posts' => fn($q) => $q->where('status', 'published')])
            ->get()
            ->map(fn($cat) => [
                'label' => $cat->trans('title'),
                'url'   => '/articles/category/' . \Illuminate\Support\Str::slug($cat->trans('title')),
                'count' => $cat->posts_count,
            ]);

        // ============================================================
        // SIDEBAR — RECENT POSTS
        // 3 post published terbaru
        // ============================================================
        $recentPosts = Post::where('status', 'published')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($post) => [
                'thumb'    => $post->image,
                'date'     => $post->created_at->format('d M, Y'),
                'date_url' => '/posts-by-date',
                'title'    => $post->trans('title'),
                'url'      => '/articles/' . $post->slug,
            ]);

        // ============================================================
        // SIDEBAR — TAGS
        // Tidak ada model Tag di schema — kosongkan atau buat model Tag tersendiri
        // ============================================================
        $tags = [];

        // ============================================================
        // POSTS — Paginated dengan Eloquent
        // ============================================================
        $posts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->latest()
            ->paginate(self::PER_PAGE)
            ->through(fn($post) => [
                'image'        => $post->image,
                'category'     => $post->category?->trans('title'),
                'category_url' => '/articles/category/' . \Illuminate\Support\Str::slug($post->category?->trans('title')),
                'author'       => $post->user?->name ?? 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => $post->created_at->format('d M, Y'),
                'date_url'     => '/posts-by-date',
                'title'        => $post->trans('title'),
                'url'          => '/articles/' . $post->slug,
            ]);

        return view('pages.marketing.articles.index', compact(
            'breadcrumb',
            'categories',
            'recentPosts',
            'tags',
            'posts'
        ));
    }

    public function show(string $slug)
    {
        // ============================================================
        // ARTIKEL UTAMA
        // ============================================================
        $post = Post::with(['category', 'user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // ============================================================
        // BREADCRUMB
        // ============================================================
        $breadcrumb = [
            'title' => 'Blog Single',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'BLOG', 'url' => '/articles'],
                ['label' => 'BLOG SINGLE', 'url' => null],
            ],
        ];

        // ============================================================
        // ARTIKEL — Map ke format view
        // content disimpan sebagai HTML/text di DB, langsung render di blade
        // ============================================================
        $article = [
            'category'     => $post->category?->trans('title'),
            'category_url' => '/articles/category/' . \Illuminate\Support\Str::slug($post->category?->trans('title')),
            'author'       => $post->user?->name ?? 'Admin',
            'author_url'   => '/posts-by-author',
            'date'         => $post->created_at->format('d M, Y'),
            'date_url'     => '/posts-by-date',
            'title'        => $post->trans('title'),
            'hero_image'   => $post->image,
            'content'      => $post->trans('content'), // raw HTML dari editor (TinyMCE/Quill/dsb)
            'meta_title'       => $post->meta_title,
            'meta_description' => $post->meta_description,

            // Navigasi prev/next berdasarkan created_at
            'prev' => $this->getPrevPost($post),
            'next' => $this->getNextPost($post),

            // Tags — kosongkan dulu, isi jika sudah ada model Tag
            'tags' => [],

            // Social share — {url} diganti di blade dengan URL artikel aktif
            'share' => [
                ['icon' => 'ri-facebook-fill',  'url' => 'https://www.facebook.com/sharer/sharer.php?u={url}',  'label' => 'Facebook'],
                ['icon' => 'ri-twitter-x-line', 'url' => 'https://twitter.com/intent/tweet?url={url}',          'label' => 'Twitter'],
                ['icon' => 'ri-linkedin-fill',  'url' => 'https://www.linkedin.com/shareArticle?url={url}',      'label' => 'LinkedIn'],
                ['icon' => 'ri-instagram-line', 'url' => 'https://www.instagram.com/',                           'label' => 'Instagram'],
            ],
        ];

        // ============================================================
        // KOMENTAR
        // Tidak ada model Comment di schema — kosongkan dulu
        // Jika sudah ada: $comments = $post->comments()->whereNull('parent_id')->with('replies.user')->get();
        // ============================================================
        $comments = [];

        // ============================================================
        // ARTIKEL TERKAIT — Satu kategori, beda slug, max 3
        // ============================================================
        $relatedPosts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($related) => [
                'image'        => $related->image,
                'category'     => $related->category?->trans('title'),
                'category_url' => '/articles/category/' . \Illuminate\Support\Str::slug($related->category?->trans('title')),
                'author'       => $related->user?->name ?? 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => $related->created_at->format('d M, Y'),
                'date_url'     => '/posts-by-date',
                'title'        => $related->trans('title'),
                'url'          => '/articles/' . $related->slug,
            ]);

        // ============================================================
        // SIDEBAR — CATEGORIES (reused di halaman show)
        // ============================================================
        $categories = Category::withCount(['posts' => fn($q) => $q->where('status', 'published')])
            ->get()
            ->map(fn($cat) => [
                'label' => $cat->trans('title'),
                'url'   => '/articles/category/' . \Illuminate\Support\Str::slug($cat->trans('title')),
                'count' => $cat->posts_count,
            ]);

        // ============================================================
        // SIDEBAR — RECENT POSTS
        // ============================================================
        $recentPosts = Post::where('status', 'published')
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($p) => [
                'thumb'    => $p->image,
                'date'     => $p->created_at->format('d M, Y'),
                'date_url' => '/posts-by-date',
                'title'    => $p->trans('title'),
                'url'      => '/articles/' . $p->slug,
            ]);

        return view('pages.marketing.articles.show', compact(
            'breadcrumb',
            'article',
            'comments',
            'relatedPosts',
            'categories',
            'recentPosts'
        ));
    }

    // ================================================================
    // HELPER — Prev / Next Post
    // ================================================================

    private function getPrevPost(Post $post): ?array
    {
        $prev = Post::where('status', 'published')
            ->where('created_at', '<', $post->created_at)
            ->latest()
            ->first();

        return $prev ? [
            'label' => 'Prev Article',
            'title' => $prev->trans('title'),
            'url'   => '/articles/' . $prev->slug,
        ] : null;
    }

    private function getNextPost(Post $post): ?array
    {
        $next = Post::where('status', 'published')
            ->where('created_at', '>', $post->created_at)
            ->oldest()
            ->first();

        return $next ? [
            'label' => 'Next Article',
            'title' => $next->trans('title'),
            'url'   => '/articles/' . $next->slug,
        ] : null;
    }
}