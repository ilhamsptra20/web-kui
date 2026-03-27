<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MarketingController extends Controller
{
    public function index()
    {
        // ============================================================
        // HERO SLIDER
        // ============================================================
        $heroSlides = [
            [
                'subtitle'    => 'SMARTER SECURITY, POWERED BY AI!',
                'title'       => 'AI-Powered <span class="text_primary fw-bold">Cybersecurity</span> For A Safer Digital World',
                'description' => 'Protect your business with real-time threat detection, predictive analytics, and autonomous defense systems that never sleep.',
                'btn_text'    => 'Get Started',
                'btn_url'     => '/contact',
                'image'       => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=900&q=80',
                'bg_class'    => 'bg-f',
            ],
            [
                'subtitle'    => 'ZERO TRUST ARCHITECTURE',
                'title'       => 'Protect Every <span class="text_primary fw-bold">Endpoint</span> With Intelligent Access Control',
                'description' => 'Our zero trust model ensures every user, device, and connection is continuously verified before access is granted.',
                'btn_text'    => 'Learn More',
                'btn_url'     => '/services',
                'image'       => 'https://images.unsplash.com/photo-1563986768494-4dee2763ff3f?w=900&q=80',
                'bg_class'    => 'bg-f',
            ],
            [
                'subtitle'    => 'CLOUD SECURITY & MONITORING',
                'title'       => 'Seamless <span class="text_primary fw-bold">Cloud Defense</span> Across AWS, Azure & Google Cloud',
                'description' => 'Monitor, detect, and respond to threats across all your cloud environments from a single unified dashboard.',
                'btn_text'    => 'Explore Platform',
                'btn_url'     => '/platform',
                'image'       => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=900&q=80',
                'bg_class'    => 'bg-f',
            ],
        ];

        // ============================================================
        // ABOUT
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
        // ============================================================
        $blogPosts = [
            [
                'image'        => 'https://images.unsplash.com/photo-1614064641938-3bbee52942c7?w=600&q=80',
                'category'     => 'Cybersecurity',
                'category_url' => '/blog/category/cybersecurity',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '12 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'How AI Is Revolutionizing Cybersecurity Defense Systems',
                'url'          => '/blog/ai-revolutionizing-cybersecurity',
                'read_more_text' => 'Read More',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1510511459019-5dda7724fd87?w=600&q=80',
                'category'     => 'Technology',
                'category_url' => '/blog/category/technology',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '16 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Top 10 Cyber Security Threats Every Business Should Watch In 2025',
                'url'          => '/blog/top-10-cybersecurity-threats-2025',
                'read_more_text' => 'Read More',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&q=80',
                'category'     => 'Cloud',
                'category_url' => '/blog/category/cloud',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '22 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'Cloud Security Best Practices for Multi-Platform Environments',
                'url'          => '/blog/cloud-security-best-practices',
                'read_more_text' => 'Read More',
            ],
            [
                'image'        => 'https://images.unsplash.com/photo-1639322537228-f710d846310a?w=600&q=80',
                'category'     => 'Zero Trust',
                'category_url' => '/blog/category/zero-trust',
                'author'       => 'Admin',
                'author_url'   => '/posts-by-author',
                'date'         => '25 Aug, 2025',
                'date_url'     => '/posts-by-date',
                'title'        => 'The Benefits Of Zero Trust Architecture For Modern Enterprises',
                'url'          => '/blog/zero-trust-architecture-benefits',
                'read_more_text' => 'Read More',
            ],
        ];

        // ============================================================
        // GALLERY
        // ============================================================
        $gallery = [
            'subtitle'     => 'OUR GALLERY',
            'title'        => 'A Glimpse Into Our Security Operations Center',
            'see_all_url'  => '/gallery',
            'see_all_text' => 'View Full Gallery',
            'items'        => [
                [
                    'image'   => 'https://images.unsplash.com/photo-1581092787765-e3feb951d987?w=800&q=80',
                    'caption' => 'SOC Operations Center',
                    'url'     => '/gallery/soc-operations',
                ],
                [
                    'image'   => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=600&q=80',
                    'caption' => 'Threat Analysis Dashboard',
                    'url'     => '/gallery/threat-analysis',
                ],
                [
                    'image'   => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&q=80',
                    'caption' => 'Team Collaboration',
                    'url'     => '/gallery/team',
                ],
                [
                    'image'   => 'https://images.unsplash.com/photo-1551808525-51a94da548ce?w=600&q=80',
                    'caption' => 'Network Monitoring',
                    'url'     => '/gallery/network-monitoring',
                ],
                [
                    'image'   => 'https://images.unsplash.com/photo-1573164713988-8665fc963095?w=800&q=80',
                    'caption' => 'AI Research Lab',
                    'url'     => '/gallery/ai-lab',
                ],
                [
                    'image'   => 'https://images.unsplash.com/photo-1563206767-5b18f218e8de?w=600&q=80',
                    'caption' => 'Incident Response Room',
                    'url'     => '/gallery/incident-response',
                ],
            ],
        ];

        return view('pages.marketing.index', compact(
            'heroSlides',
            'about',
            'blogSection',
            'blogPosts',
            'gallery'
        ));
    }
}