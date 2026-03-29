<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ArticleController extends Controller
{
    /**
     * Jumlah artikel per halaman
     */
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
        // ============================================================
        $categories = [
            ['label' => 'Cybersecurity',      'url' => '/articles/category/cybersecurity',      'count' => 12],
            ['label' => 'Cloud Security',     'url' => '/articles/category/cloud-security',     'count' => 8],
            ['label' => 'Machine Learning',   'url' => '/articles/category/machine-learning',   'count' => 15],
            ['label' => 'Zero Trust',         'url' => '/articles/category/zero-trust',         'count' => 6],
            ['label' => 'Threat Intelligence','url' => '/articles/category/threat-intelligence','count' => 9],
            ['label' => 'Incident Response',  'url' => '/articles/category/incident-response',  'count' => 5],
        ];

        // ============================================================
        // SIDEBAR — RECENT POSTS
        // ============================================================
        $recentPosts = [
            [
                'thumb'    => 'https://images.unsplash.com/photo-1614064641938-3bbee52942c7?w=120&q=80',
                'date'     => '19 Aug, 2025',
                'date_url' => '/posts-by-date',
                'title'    => 'How Predictive AI Is Transforming Decision-Making In Business',
                'url'      => '/articles/predictive-ai-decision-making',
            ],
            [
                'thumb'    => 'https://images.unsplash.com/photo-1510511459019-5dda7724fd87?w=120&q=80',
                'date'     => '16 Aug, 2025',
                'date_url' => '/posts-by-date',
                'title'    => 'Building Trust In AI: Transparency, Accuracy & Accountability',
                'url'      => '/articles/building-trust-in-ai',
            ],
            [
                'thumb'    => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=120&q=80',
                'date'     => '22 Aug, 2025',
                'date_url' => '/posts-by-date',
                'title'    => 'From Data To Action: The Power Of Machine Learning',
                'url'      => '/articles/data-to-action-machine-learning',
            ],
        ];

        // ============================================================
        // SIDEBAR — TAGS
        // ============================================================
        $tags = [
            ['label' => 'AI Security',  'url' => '/articles/tag/ai-security'],
            ['label' => 'Analysis',     'url' => '/articles/tag/analysis'],
            ['label' => 'Zero Trust',   'url' => '/articles/tag/zero-trust'],
            ['label' => 'Cloud',        'url' => '/articles/tag/cloud'],
            ['label' => 'AI Model',     'url' => '/articles/tag/ai-model'],
            ['label' => 'Encryption',   'url' => '/articles/tag/encryption'],
            ['label' => 'Threat Intel', 'url' => '/articles/tag/threat-intel'],
            ['label' => 'SOC',          'url' => '/articles/tag/soc'],
        ];

        // ============================================================
        // SEMUA ARTIKEL (nanti ganti dengan query DB)
        // Contoh: $allPosts = Post::latest()->get()->toArray();
        // ============================================================
        $allPosts = [
            // ── Halaman 1 ──────────────────────────────────────────
            [
                'image'        => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=700&q=80',
                'category'     => 'Cybersecurity',
                'category_url' => '/articles/category/cybersecurity',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '12 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'How AI Automation Is Reshaping The Future Of Business Security Operations',
                'url'          => '/articles/ai-automation-business-security',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1563986768494-4dee2763ff3f?w=700&q=80',
                'category'     => 'Technology',
                'category_url' => '/articles/category/technology',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '16 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Top 7 Ways SaaS Companies Benefit From Predictive Security Analytics',
                'url'          => '/articles/saas-predictive-analytics',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=700&q=80',
                'category'     => 'Cloud Security',
                'category_url' => '/articles/category/cloud-security',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '22 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Scaling Smarter: How Startups Use AI To Accelerate Secure Business Growth',
                'url'          => '/articles/startups-ai-secure-growth',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=700&q=80',
                'category'     => 'Threat Intelligence',
                'category_url' => '/articles/category/threat-intelligence',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '26 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'How Predictive AI Is Transforming Real-Time Decision-Making In Business',
                'url'          => '/articles/predictive-ai-real-time',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1614064641938-3bbee52942c7?w=700&q=80',
                'category'     => 'Zero Trust',
                'category_url' => '/articles/category/zero-trust',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '27 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Building Trust In AI: Transparency, Accuracy, And Accountability In Security',
                'url'          => '/articles/trust-ai-transparency',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1639322537228-f710d846310a?w=700&q=80',
                'category'     => 'Machine Learning',
                'category_url' => '/articles/category/machine-learning',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '28 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'From Data To Action: The Power Of Machine Learning In Security Forecasting',
                'url'          => '/articles/machine-learning-forecasting',
            ],
            // ── Halaman 2 ──────────────────────────────────────────
            [
                'image'        => 'https://images.unsplash.com/photo-1510511459019-5dda7724fd87?w=700&q=80',
                'category'     => 'Incident Response',
                'category_url' => '/articles/category/incident-response',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '02 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Autonomous Incident Response: How AI Neutralizes Threats In Milliseconds',
                'url'          => '/articles/autonomous-incident-response',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=700&q=80',
                'category'     => 'Cloud Security',
                'category_url' => '/articles/category/cloud-security',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '05 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Multi-Cloud Security: Protecting AWS, Azure, And Google Cloud Simultaneously',
                'url'          => '/articles/multi-cloud-security',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1573164713988-8665fc963095?w=700&q=80',
                'category'     => 'Cybersecurity',
                'category_url' => '/articles/category/cybersecurity',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '08 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Behavioral Analytics: Detecting Insider Threats Before They Cause Damage',
                'url'          => '/articles/behavioral-analytics-insider-threats',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1581092787765-e3feb951d987?w=700&q=80',
                'category'     => 'Zero Trust',
                'category_url' => '/articles/category/zero-trust',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '10 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Implementing Zero Trust In Legacy Infrastructure: A Practical Guide',
                'url'          => '/articles/zero-trust-legacy-infrastructure',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=700&q=80',
                'category'     => 'Machine Learning',
                'category_url' => '/articles/category/machine-learning',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '14 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'How Neural Networks Learn To Identify Zero-Day Vulnerabilities',
                'url'          => '/articles/neural-networks-zero-day',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1563206767-5b18f218e8de?w=700&q=80',
                'category'     => 'Threat Intelligence',
                'category_url' => '/articles/category/threat-intelligence',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '18 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Dark Web Monitoring: How AI Tracks Stolen Credentials In Real Time',
                'url'          => '/articles/dark-web-monitoring-ai',
            ],
            // ── Halaman 3 ──────────────────────────────────────────
            [
                'image'        => 'https://images.unsplash.com/photo-1551808525-51a94da548ce?w=700&q=80',
                'category'     => 'Cybersecurity',
                'category_url' => '/articles/category/cybersecurity',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '22 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Ransomware Defense: Proactive AI Strategies To Protect Your Enterprise',
                'url'          => '/articles/ransomware-defense-ai',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=700&q=80',
                'category'     => 'Technology',
                'category_url' => '/articles/category/technology',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '25 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'DevSecOps: Integrating Security Into Every Stage Of The CI/CD Pipeline',
                'url'          => '/articles/devsecops-cicd-pipeline',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=700&q=80',
                'category'     => 'Compliance',
                'category_url' => '/articles/category/compliance',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '28 Sep, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'GDPR, ISO 27001 & SOC 2: How AI Simplifies Compliance Reporting',
                'url'          => '/articles/ai-compliance-reporting',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=700&q=80',
                'category'     => 'Cloud Security',
                'category_url' => '/articles/category/cloud-security',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '01 Oct, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Cloud-Native Security: Building Resilient Applications From The Ground Up',
                'url'          => '/articles/cloud-native-security',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1563986768494-4dee2763ff3f?w=700&q=80',
                'category'     => 'Incident Response',
                'category_url' => '/articles/category/incident-response',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '04 Oct, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Post-Breach Recovery: Lessons Learned From Major Security Incidents',
                'url'          => '/articles/post-breach-recovery',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1639322537228-f710d846310a?w=700&q=80',
                'category'     => 'Machine Learning',
                'category_url' => '/articles/category/machine-learning',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '07 Oct, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Federated Learning: Training AI Security Models Without Exposing Sensitive Data',
                'url'          => '/articles/federated-learning-security',
            ],
        ];

        // ============================================================
        // PAGINATION DENGAN LengthAwarePaginator
        // Kalau sudah pakai Eloquent/DB, ganti dengan:
        // $posts = Post::latest()->paginate(self::PER_PAGE);
        // ============================================================
        $currentPage  = LengthAwarePaginator::resolveCurrentPage(); // ambil ?page= dari URL
        $collection   = new Collection($allPosts);
        $perPage      = self::PER_PAGE;

        // Slice data sesuai halaman
        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        // Buat paginator
        $posts = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),    // total semua item
            $perPage,
            $currentPage,
            [
                'path'     => $request->url(),   // URL dasar (tanpa ?page=)
                'pageName' => 'page',
            ]
        );

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
        // NANTI GANTI DENGAN:
        // $article = Article::where('slug', $slug)->firstOrFail();
        // ============================================================
 
        // ============================================================
        // BREADCRUMB
        // ============================================================
        $breadcrumb = [
            'title' => 'Blog Single',
            'menus' => [
                ['label' => 'HOME', 'url'  => '/'],
                ['label' => 'BLOG', 'url'  => '/blog'],
                ['label' => 'BLOG SINGLE', 'url' => null],
            ],
        ];
 
        // ============================================================
        // ARTIKEL UTAMA
        // ============================================================
        $article = [
            'category'     => 'Cybersecurity',
            'category_url' => '/articles/category/cybersecurity',
            'author'       => 'Admin',
            'author_url'   => '/posts-by-author',
            'date'         => '12 Aug, 2025',
            'date_url'     => '/posts-by-date',
            'title'        => 'How Predictive AI Is Transforming Decision-Making In Business Security',
            'hero_image'   => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=1200&q=85',
 
            // Konten artikel — array of blocks
            // type: 'paragraph' | 'heading' | 'bullets' | 'blockquote' | 'images'
            'content'      => [
                [
                    'type' => 'paragraph',
                    'text' => 'Predictive AI is no longer a futuristic concept — it\'s a practical tool reshaping how organizations protect themselves. From forecasting attack vectors to preventing data breaches before they occur, businesses are using AI to make security decisions that are smarter, faster, and backed by real-time intelligence.',
                ],
                [
                    'type'  => 'heading',
                    'level' => 'h6',
                    'text'  => 'Benefits of Using Predictive AI in Cybersecurity',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'AI offers security teams a powerful way to anticipate future threats and neutralize them before damage is done. By analyzing historical attack patterns and real-time telemetry, it enables organizations to reduce risk exposure and respond at machine speed.',
                ],
                [
                    'type'  => 'bullets',
                    'items' => [
                        'Anticipates attack vectors and threat patterns with high accuracy',
                        'Reduces breach response time from hours to milliseconds',
                        'Enhances decision-making speed and analyst confidence',
                        'Improves threat containment with autonomous incident response',
                        'Minimizes risk by identifying vulnerabilities before exploitation',
                    ],
                ],
                [
                    'type'      => 'blockquote',
                    'text'      => '"Aixio\'s AI platform detected a sophisticated phishing campaign targeting our executives hours before it launched. Their automated response prevented a major data breach, and the compliance tools made our audits effortless."',
                    'author'    => 'Michael Reyes',
                    'position'  => 'CISO, DataTrust Corp',
                ],
                [
                    'type'  => 'heading',
                    'level' => 'h6',
                    'text'  => 'Challenges and Considerations',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'Security leaders must navigate several challenges when deploying AI-powered systems. Understanding these limitations is key to building a resilient, trustworthy defense architecture.',
                ],
                [
                    'type'  => 'bullets',
                    'items' => [
                        'Data quality and availability across hybrid environments',
                        'Model bias and adversarial manipulation risks',
                        'Integration with legacy SIEM and SOAR systems',
                        'Ensuring explainability and regulatory compliance',
                    ],
                ],
                [
                    'type'   => 'images',
                    'images' => [
                        [
                            'src' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=700&q=80',
                            'alt' => 'Threat Analysis Dashboard',
                        ],
                        [
                            'src' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=700&q=80',
                            'alt' => 'SOC Team Operations',
                        ],
                    ],
                ],
                [
                    'type'  => 'heading',
                    'level' => 'h6',
                    'text'  => 'Conclusion',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'Predictive AI empowers security leaders to move from reactive incident response to proactive, insight-driven defense. As models improve and threat data pipelines mature, organizations that embrace AI-powered security will lead their industries with greater resilience, clarity, and speed.',
                ],
            ],
 
            // Navigasi artikel prev/next
            'prev' => [
                'label' => 'Prev Article',
                'url'   => '/articles/zero-trust-architecture-benefits',
            ],
            'next' => [
                'label' => 'Next Article',
                'url'   => '/articles/cloud-security-best-practices',
            ],
 
            // Tags artikel
            'tags' => [
                ['label' => 'AI Security',  'url' => '/articles/tag/ai-security'],
                ['label' => 'Zero Trust',   'url' => '/articles/tag/zero-trust'],
                ['label' => 'Threat Intel', 'url' => '/articles/tag/threat-intel'],
            ],
 
            // Social share links — {url} akan diganti URL artikel saat ini
            'share' => [
                ['icon' => 'ri-facebook-fill',  'url' => 'https://www.facebook.com/sharer/sharer.php?u={url}',  'label' => 'Facebook'],
                ['icon' => 'ri-twitter-x-line', 'url' => 'https://twitter.com/intent/tweet?url={url}',          'label' => 'Twitter'],
                ['icon' => 'ri-linkedin-fill',  'url' => 'https://www.linkedin.com/shareArticle?url={url}',      'label' => 'LinkedIn'],
                ['icon' => 'ri-instagram-line', 'url' => 'https://www.instagram.com/',                           'label' => 'Instagram'],
            ],
        ];
 
        // ============================================================
        // KOMENTAR
        // Nanti ganti dengan: $comments = $article->comments()->whereNull('parent_id')->with('replies')->get();
        // ============================================================
        $comments = [
            [
                'id'      => 1,
                'avatar'  => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80&q=80',
                'name'    => 'Sarah Wilson',
                'date'    => '3 days ago',
                'text'    => 'Business owners face increasing pressure to manage security risks, reduce attack surfaces, and plan for sustainable digital growth. Whether you\'re just launching your business or scaling an existing operation, AI-driven security is no longer optional.',
                'replies' => [
                    [
                        'id'     => 2,
                        'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&q=80',
                        'name'   => 'Charles Vaughan',
                        'date'   => '2 days ago',
                        'text'   => 'Totally agree. The instructors at our last security workshop were highly knowledgeable, and the course content was top-notch. I gained valuable insights and hands-on experience that directly applied to our SOC.',
                    ],
                ],
            ],
            [
                'id'      => 3,
                'avatar'  => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=80&q=80',
                'name'    => 'Machel Vaun',
                'date'    => '3 days ago',
                'text'    => 'This article is very applicable to what we\'re building. The section on predictive models is spot on. Thank you for breaking down the technical concepts so clearly — even non-security folks in our team could follow along.',
                'replies' => [],
            ],
        ];
 
        // ============================================================
        // ARTIKEL TERKAIT (Related Posts)
        // Nanti: $related = Article::where('category', $article['category'])->where('slug','!=',$slug)->take(3)->get();
        // ============================================================
        $relatedPosts = [
            [
                'image'        => 'https://images.unsplash.com/photo-1563986768494-4dee2763ff3f?w=600&q=80',
                'category'     => 'Cybersecurity',
                'category_url' => '/articles/category/cybersecurity',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '15 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Zero-Day Exploits: How AI Detects The Unknown Before It Strikes',
                'url'          => '/articles/zero-day-exploits-ai',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1573164713988-8665fc963095?w=600&q=80',
                'category'     => 'Machine Learning',
                'category_url' => '/articles/category/machine-learning',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '20 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Behavioral Analytics: Detecting Insider Threats Before They Cause Damage',
                'url'          => '/articles/behavioral-analytics-insider-threats',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1639322537228-f710d846310a?w=600&q=80',
                'category'     => 'Cloud Security',
                'category_url' => '/articles/category/cloud-security',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '24 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Cloud Security Best Practices for Multi-Platform Environments',
                'url'          => '/articles/cloud-security-best-practices',
            ],
        ];
 
        return view('pages.marketing.articles.show', compact(
            'breadcrumb',
            'article',
            'comments',
            'relatedPosts'
        ));
    }
}