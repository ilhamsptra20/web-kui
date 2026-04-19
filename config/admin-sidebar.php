<?php

return [
    'items' => [
        ['header' => 'Main Menu'],
        [
            'title' => 'Dashboard',
            'icon' => 'feather icon-home',
            'url' => '/dashboard',
            'route_name' => 'dashboard',
        ],

        ['header' => 'Content Manager'],
        [
            'title' => 'Category',
            'icon' => 'feather icon-list',
            'url' => '/categories',
            'route_name' => 'categories.index',
        ],
        [
            'title' => 'Posts',
            'icon' => 'feather icon-file-text',
            'url' => '/posts',
            'route_name' => 'posts.index',
        ],

        ['header' => 'Media & Gallery'],
        [
            'title' => 'Page',
            'icon' => 'feather icon-folder',
            'url' => '/pages',
            'route_name' => 'pages.index',
        ],
        [
            'title' => 'Album',
            'icon' => 'feather icon-folder',
            'url' => '/albums',
            'route_name' => 'albums.index',
        ],
        [
            'title' => 'Gallery',
            'icon' => 'feather icon-image',
            'url' => '/galleries',
            'route_name' => 'galleries.index',
        ],
        [
            'title' => 'Video',
            'icon' => 'feather icon-video',
            'url' => '/videos',
            'route_name' => 'videos.index',
        ],
        [
            'title' => 'Slider',
            'icon' => 'feather icon-monitor',
            'url' => '/sliders',
            'route_name' => 'sliders.index',
        ],
        [
            'title' => 'Lembaga',
            'icon' => 'feather icon-briefcase',
            'url' => '/lembagas',
            'route_name' => 'lembagas.index',
        ],
        [
            'title' => 'Relasi',
            'icon' => 'feather icon-link',
            'url' => '/relations',
            'route_name' => 'relations.index',
        ],


        ['header' => 'Information'],
        [
            'title' => 'Agenda',
            'icon' => 'feather icon-calendar',
            'url' => '/agendas',
            'route_name' => 'agendas.index',
        ],
        [
            'title' => 'Announcement',
            'icon' => 'feather icon-bell',
            'url' => '/announcements',
            'route_name' => 'announcements.index',
        ],
        [
            'title' => 'Inbox',
            'icon' => 'feather icon-mail',
            'url' => '/inboxes',
            'route_name' => 'inboxes.index',
            'badge' => ['class' => 'badge-primary', 'text' => 'new'],
        ],

        ['header' => 'Team Manager'],
        [
            'title' => 'Position',
            'icon' => 'feather icon-map-pin',
            'url' => '/positions',
            'route_name' => 'positions.index',
        ],
        [
            'title' => 'Team',
            'icon' => 'feather icon-users',
            'url' => '/teams',
            'route_name' => 'teams.index',
        ],

        ['header' => 'System'],
        [
            'title' => 'Users',
            'icon' => 'feather icon-users',
            'url' => '/users',
            'route_name' => 'users.index',
        ],
        [
            'title' => 'Roles',
            'icon' => 'feather icon-shield',
            'url' => '/roles',
            'route_name' => 'roles.index',
        ],
        [
            'title' => 'Permissions',
            'icon' => 'feather icon-lock',
            'url' => '/permissions',
            'route_name' => 'permissions.index',
        ],
        [
            'title' => 'Social Media',
            'icon' => 'feather icon-share-2',
            'url' => '/social_media',
            'route_name' => 'social_media.index',
        ],
        [
            'title' => 'Setting',
            'icon' => 'feather icon-settings',
            'url' => '/settings',
            'route_name' => 'settings.index',
        ],
        [
            'title' => 'Navigation',
            'icon' => 'feather icon-menu',
            'url' => '/navigations',
            'route_name' => 'navigations.index',
        ],
    ],
];
