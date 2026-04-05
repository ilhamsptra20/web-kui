<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Support\RichText\RichTextSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    private const PER_PAGE = 6;

    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $categorySegment = $request->route('category');
        $activeCategory = $this->resolveCategory($categorySegment);

        $breadcrumb = [
            'title' => $activeCategory
                ? 'Artikel: ' . ($activeCategory->trans('title') ?? 'Kategori')
                : ($search !== '' ? 'Pencarian Artikel' : 'Artikel & Berita'),
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'ARTIKEL', 'url' => null],
            ],
        ];

        $categories = Category::withCount(['posts' => fn ($query) => $query->where('status', 'published')])
            ->get()
            ->map(fn (Category $category) => [
                'label' => $category->trans('title'),
                'url' => route('article.category-marketing', Str::slug((string) $category->trans('title'))),
                'count' => $category->posts_count,
                'active' => $activeCategory?->is($category) ?? false,
            ]);

        $recentPosts = Post::query()
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Post $post) => [
                'thumb' => $post->image,
                'date' => $post->created_at->format('d M, Y'),
                'date_url' => '#',
                'title' => $post->trans('title'),
                'url' => route('article.show-marketing', $post->slug),
            ]);

        $tags = [];

        $posts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->when($activeCategory, fn ($query) => $query->where('category_id', $activeCategory->id))
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($innerQuery) use ($search): void {
                    $likeSearch = '%' . $search . '%';

                    $innerQuery
                        ->where('title_id', 'like', $likeSearch)
                        ->orWhere('title_en', 'like', $likeSearch)
                        ->orWhere('title_ar', 'like', $likeSearch)
                        ->orWhere('content_id', 'like', $likeSearch)
                        ->orWhere('content_en', 'like', $likeSearch)
                        ->orWhere('content_ar', 'like', $likeSearch);
                });
            })
            ->latest()
            ->paginate(self::PER_PAGE)
            ->withQueryString()
            ->through(fn (Post $post) => [
                'image' => $post->image,
                'category' => $post->category?->trans('title'),
                'category_url' => $post->category?->trans('title')
                    ? route('article.category-marketing', Str::slug((string) $post->category?->trans('title')))
                    : '#',
                'author' => $post->user?->name ?? 'Admin',
                'author_url' => '#',
                'date' => $post->created_at->format('d M, Y'),
                'date_url' => '#',
                'title' => $post->trans('title'),
                'url' => route('article.show-marketing', $post->slug),
                'read_more_text' => 'Baca Selengkapnya',
            ]);

        return view('pages.marketing.articles.index', compact(
            'breadcrumb',
            'categories',
            'recentPosts',
            'tags',
            'posts',
            'search',
            'activeCategory'
        ));
    }

    public function show(string $slug, RichTextSanitizer $sanitizer)
    {
        $post = Post::with(['category', 'user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $breadcrumb = [
            'title' => 'Detail Artikel',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'ARTIKEL', 'url' => route('articles-marketing')],
                ['label' => 'DETAIL', 'url' => null],
            ],
        ];

        $article = [
            'category' => $post->category?->trans('title'),
            'category_url' => $post->category?->trans('title')
                ? route('article.category-marketing', Str::slug((string) $post->category?->trans('title')))
                : '#',
            'author' => $post->user?->name ?? 'Admin',
            'author_url' => '#',
            'date' => $post->created_at->format('d M, Y'),
            'date_url' => '#',
            'title' => $post->trans('title'),
            'hero_image' => $post->image,
            'content_html' => $sanitizer->sanitize($post->trans('content')),
            'meta_title' => $post->meta_title,
            'meta_description' => $post->meta_description,
            'prev' => $this->getPrevPost($post),
            'next' => $this->getNextPost($post),
            'tags' => [],
            'share' => [
                ['icon' => 'ri-facebook-fill', 'url' => 'https://www.facebook.com/sharer/sharer.php?u={url}', 'label' => 'Facebook'],
                ['icon' => 'ri-twitter-x-line', 'url' => 'https://twitter.com/intent/tweet?url={url}', 'label' => 'Twitter'],
                ['icon' => 'ri-linkedin-fill', 'url' => 'https://www.linkedin.com/shareArticle?url={url}', 'label' => 'LinkedIn'],
                ['icon' => 'ri-instagram-line', 'url' => 'https://www.instagram.com/', 'label' => 'Instagram'],
            ],
        ];

        $comments = [];

        $relatedPosts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->where('slug', '!=', $slug)
            ->when($post->category_id, fn ($query) => $query->where('category_id', $post->category_id))
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Post $related) => [
                'image' => $related->image,
                'category' => $related->category?->trans('title'),
                'category_url' => $related->category?->trans('title')
                    ? route('article.category-marketing', Str::slug((string) $related->category?->trans('title')))
                    : '#',
                'author' => $related->user?->name ?? 'Admin',
                'author_url' => '#',
                'date' => $related->created_at->format('d M, Y'),
                'date_url' => '#',
                'title' => $related->trans('title'),
                'url' => route('article.show-marketing', $related->slug),
                'read_more_text' => 'Baca Selengkapnya',
            ]);

        $categories = Category::withCount(['posts' => fn ($query) => $query->where('status', 'published')])
            ->get()
            ->map(fn (Category $category) => [
                'label' => $category->trans('title'),
                'url' => route('article.category-marketing', Str::slug((string) $category->trans('title'))),
                'count' => $category->posts_count,
            ]);

        $recentPosts = Post::query()
            ->where('status', 'published')
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Post $postItem) => [
                'thumb' => $postItem->image,
                'date' => $postItem->created_at->format('d M, Y'),
                'date_url' => '#',
                'title' => $postItem->trans('title'),
                'url' => route('article.show-marketing', $postItem->slug),
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

    private function getPrevPost(Post $post): ?array
    {
        $previousPost = Post::query()
            ->where('status', 'published')
            ->where('created_at', '<', $post->created_at)
            ->latest()
            ->first();

        return $previousPost ? [
            'label' => 'Artikel Sebelumnya',
            'title' => $previousPost->trans('title'),
            'url' => route('article.show-marketing', $previousPost->slug),
        ] : null;
    }

    private function getNextPost(Post $post): ?array
    {
        $nextPost = Post::query()
            ->where('status', 'published')
            ->where('created_at', '>', $post->created_at)
            ->oldest()
            ->first();

        return $nextPost ? [
            'label' => 'Artikel Berikutnya',
            'title' => $nextPost->trans('title'),
            'url' => route('article.show-marketing', $nextPost->slug),
        ] : null;
    }

    private function resolveCategory(mixed $segment): ?Category
    {
        if (! is_string($segment) || trim($segment) === '') {
            return null;
        }

        return Category::query()
            ->get()
            ->first(function (Category $category) use ($segment): bool {
                $candidates = collect([
                    $category->trans('title'),
                    $category->title_id ?? null,
                    $category->title_en ?? null,
                    $category->title_ar ?? null,
                ])->filter();

                return $candidates->contains(fn (string $title): bool => Str::slug($title) === $segment);
            });
    }
}
