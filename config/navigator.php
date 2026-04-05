<?php 

return [
    'sidebar' => [
        ['header' => 'Main Menu'],
        [
            'title' => 'Dashboard',
            'icon'  => 'feather icon-home',
            'url'   => '/dashboard',
        ],

        ['header' => 'Content Manager'],
        [
            'title' => 'Category',
            'icon'  => 'feather icon-list',
            'url'   => '/categories',
        ],
        [
            'title' => 'Posts',
            'icon'  => 'feather icon-file-text',
            'url'   => '/posts',
        ],

        ['header' => 'Media & Gallery'],
        [
            'title' => 'Page',
            'icon'  => 'feather icon-folder',
            'url'   => '/pages',
        ],
        [
            'title' => 'Album',
            'icon'  => 'feather icon-folder',
            'url'   => '/albums',
        ],
        [
            'title' => 'Gallery',
            'icon'  => 'feather icon-image',
            'url'   => '/galleries',
        ],
        [
            'title' => 'Video',
            'icon'  => 'feather icon-video',
            'url'   => '/videos',
        ],
        [
            'title' => 'Slider',
            'icon'  => 'feather icon-monitor',
            'url'   => '/sliders',
        ],
        [
            'title' => 'Lembaga',
            'icon'  => 'feather icon-monitor',
            'url'   => '/lembagas',
        ],

        ['header' => 'Information'],
        [
            'title' => 'Agenda',
            'icon'  => 'feather icon-calendar',
            'url'   => '/agendas',
        ],
        [
            'title' => 'Announcement',
            'icon'  => 'feather icon-bell',
            'url'   => '/announcements',
        ],
        [
            'title' => 'Inbox',
            'icon'  => 'feather icon-mail',
            'url'   => '/inboxes',
            'badge' => ['class' => 'badge-primary', 'text' => 'new'],
        ],
        ['header' => 'Team Manager'],
        [
            'title' => 'Position',
            'icon'  => 'feather icon-map-pin',
            'url'   => '/positions',
        ],
        [
            'title' => 'Team',
            'icon'  => 'feather icon-users',
            'url'   => '/teams',
        ],

        ['header' => 'System'],
        [
            'title' => 'Users',
            'icon'  => 'feather icon-users',
            'url'   => '/users',
            'route_name' => 'users.index',
        ],
        [
            'title' => 'Roles',
            'icon'  => 'feather icon-shield',
            'url'   => '/roles',
            'route_name' => 'roles.index',
        ],
        [
            'title' => 'Permissions',
            'icon'  => 'feather icon-lock',
            'url'   => '/permissions',
            'route_name' => 'permissions.index',
        ],
        [
            'title' => 'Social Media',
            'icon'  => 'feather icon-share-2',
            'url'   => '/social_media',
        ],
        [
            'title' => 'Setting',
            'icon'  => 'feather icon-settings',
            'url'   => '/settings',
        ],
        [
            'title' => 'Navigation',
            'icon'  => 'feather icon-menu',
            'url'   => '/navigations',
        ],
    ],
    'marketing' => [
        'navbar' => [
            [
                'title' => 'Home',
                'title_id' => 'Beranda',
                'title_en' => 'Home',
                'title_ar' => 'الرئيسية',
                'url' => '/',
            ],
            [
                'title' => 'About',
                'title_id' => 'Tentang',
                'title_en' => 'About',
                'title_ar' => 'من نحن',
                'url' => '/about',
                'route_name' => 'about-marketing',
            ],
            [
                'title' => 'Events',
                'title_id' => 'Agenda',
                'title_en' => 'Events',
                'title_ar' => 'الفعاليات',
                'url' => '/events',
                'route_name' => 'events-marketing',
            ],
            [
                'title' => 'Announcements',
                'title_id' => 'Pengumuman',
                'title_en' => 'Announcements',
                'title_ar' => 'الإعلانات',
                'url' => '/announcement',
                'route_name' => 'announcements-marketing',
            ],
            [
                'title' => 'Gallery',
                'title_id' => 'Galeri',
                'title_en' => 'Gallery',
                'title_ar' => 'المعرض',
                'url' => '/gallery',
                'route_name' => 'gallery-marketing',
            ],
            [
                'title' => 'Articles',
                'title_id' => 'Artikel',
                'title_en' => 'Articles',
                'title_ar' => 'المقالات',
                'url' => '/articles',
                'route_name' => 'articles-marketing',
            ],
        ],
        'footer' => [
            [
                'title' => 'About',
                'title_id' => 'Tentang',
                'title_en' => 'About',
                'title_ar' => 'من نحن',
                'url' => '/about',
                'route_name' => 'about-marketing',
            ],
            [
                'title' => 'Events',
                'title_id' => 'Agenda',
                'title_en' => 'Events',
                'title_ar' => 'الفعاليات',
                'url' => '/events',
                'route_name' => 'events-marketing',
            ],
            [
                'title' => 'Announcements',
                'title_id' => 'Pengumuman',
                'title_en' => 'Announcements',
                'title_ar' => 'الإعلانات',
                'url' => '/announcement',
                'route_name' => 'announcements-marketing',
            ],
            [
                'title' => 'Gallery',
                'title_id' => 'Galeri',
                'title_en' => 'Gallery',
                'title_ar' => 'المعرض',
                'url' => '/gallery',
                'route_name' => 'gallery-marketing',
            ],
            [
                'title' => 'Articles',
                'title_id' => 'Artikel',
                'title_en' => 'Articles',
                'title_ar' => 'المقالات',
                'url' => '/articles',
                'route_name' => 'articles-marketing',
            ],
            [
                'title' => 'Contact',
                'title_id' => 'Kontak',
                'title_en' => 'Contact',
                'title_ar' => 'اتصل بنا',
                'url' => '/contact',
                'route_name' => 'contact-marketing',
            ],
        ],
    ],
];
