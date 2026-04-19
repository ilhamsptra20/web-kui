<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Marketing CRUD Module Presets
    |--------------------------------------------------------------------------
    |
    | Preset ini dipakai di form Navigation agar admin bisa memilih module
    | konten yang memang punya CRUD dan tampil di halaman marketing.
    |
    */
    'modules' => [
        'pages' => [
            'label' => 'Page',
            'title_id' => 'Halaman',
            'title_en' => 'Pages',
            'title_ar' => 'الصفحات',
            'url' => '#',
            'route_name' => null,
        ],
        'posts' => [
            'label' => 'Post / Article',
            'title_id' => 'Artikel',
            'title_en' => 'Articles',
            'title_ar' => 'المقالات',
            'url' => '/articles',
            'route_name' => 'articles-marketing',
        ],
        'albums_galleries' => [
            'label' => 'Album / Gallery',
            'title_id' => 'Galeri',
            'title_en' => 'Gallery',
            'title_ar' => 'المعرض',
            'url' => '/gallery',
            'route_name' => 'gallery-marketing',
        ],
        'agendas' => [
            'label' => 'Agenda / Event',
            'title_id' => 'Agenda',
            'title_en' => 'Events',
            'title_ar' => 'الفعاليات',
            'url' => '/events',
            'route_name' => 'events-marketing',
        ],
        'announcements' => [
            'label' => 'Announcement',
            'title_id' => 'Pengumuman',
            'title_en' => 'Announcements',
            'title_ar' => 'الإعلانات',
            'url' => '/announcement',
            'route_name' => 'announcements-marketing',
        ],
        'teams' => [
            'label' => 'Team',
            'title_id' => 'Tim',
            'title_en' => 'Team',
            'title_ar' => 'الفريق',
            'url' => '/team',
            'route_name' => 'teams-marketing',
        ],
    ],

    'marketing' => [
        'navbar' => [
            [
                'title_id' => 'Beranda',
                'title_en' => 'Home',
                'title_ar' => 'الرئيسية',
                'url' => '/',
            ],
            [
                'title_id' => 'Tentang',
                'title_en' => 'About',
                'title_ar' => 'من نحن',
                'url' => '/about',
                'route_name' => 'about-marketing',
            ],
            [
                'title_id' => 'Agenda',
                'title_en' => 'Events',
                'title_ar' => 'الفعاليات',
                'url' => '/events',
                'route_name' => 'events-marketing',
                'module_key' => 'agendas',
            ],
            [
                'title_id' => 'Tim',
                'title_en' => 'Team',
                'title_ar' => 'الفريق',
                'url' => '/team',
                'route_name' => 'teams-marketing',
                'module_key' => 'teams',
            ],
            [
                'title_id' => 'Pengumuman',
                'title_en' => 'Announcements',
                'title_ar' => 'الإعلانات',
                'url' => '/announcement',
                'route_name' => 'announcements-marketing',
                'module_key' => 'announcements',
            ],
            [
                'title_id' => 'Galeri',
                'title_en' => 'Gallery',
                'title_ar' => 'المعرض',
                'url' => '/gallery',
                'route_name' => 'gallery-marketing',
                'module_key' => 'albums_galleries',
            ],
            [
                'title_id' => 'Artikel',
                'title_en' => 'Articles',
                'title_ar' => 'المقالات',
                'url' => '/articles',
                'route_name' => 'articles-marketing',
                'module_key' => 'posts',
            ],
        ],
        'footer' => [
            [
                'title_id' => 'Tentang',
                'title_en' => 'About',
                'title_ar' => 'من نحن',
                'url' => '/about',
                'route_name' => 'about-marketing',
            ],
            [
                'title_id' => 'Agenda',
                'title_en' => 'Events',
                'title_ar' => 'الفعاليات',
                'url' => '/events',
                'route_name' => 'events-marketing',
                'module_key' => 'agendas',
            ],
            [
                'title_id' => 'Tim',
                'title_en' => 'Team',
                'title_ar' => 'الفريق',
                'url' => '/team',
                'route_name' => 'teams-marketing',
                'module_key' => 'teams',
            ],
            [
                'title_id' => 'Pengumuman',
                'title_en' => 'Announcements',
                'title_ar' => 'الإعلانات',
                'url' => '/announcement',
                'route_name' => 'announcements-marketing',
                'module_key' => 'announcements',
            ],
            [
                'title_id' => 'Galeri',
                'title_en' => 'Gallery',
                'title_ar' => 'المعرض',
                'url' => '/gallery',
                'route_name' => 'gallery-marketing',
                'module_key' => 'albums_galleries',
            ],
            [
                'title_id' => 'Artikel',
                'title_en' => 'Articles',
                'title_ar' => 'المقالات',
                'url' => '/articles',
                'route_name' => 'articles-marketing',
                'module_key' => 'posts',
            ],
            [
                'title_id' => 'Kontak',
                'title_en' => 'Contact',
                'title_ar' => 'اتصل بنا',
                'url' => '/contact',
                'route_name' => 'contact-marketing',
            ],
        ],
    ],
];
