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
            'url'   => '/inbox',
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
            'title' => 'Social Media',
            'icon'  => 'feather icon-share-2',
            'url'   => '/social-media',
        ],
        [
            'title' => 'Setting',
            'icon'  => 'feather icon-settings',
            'url'   => '/settings',
        ],
    ]
];