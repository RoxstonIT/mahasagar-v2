<?php

return [

    [
        'section' => 'Main',
        'items' => [
            [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'layout-dashboard',
                'permission' => null,
            ],
        ],
    ],

    [
        'section' => 'Content',
        'items' => [

            [
                'label' => 'Categories',
                'route' => 'admin.categories.index',
                'icon' => 'folder',
                'permission' => 'view_categories',
            ],

            [
                'label' => 'Articles',
                'route' => 'admin.articles.index',
                'icon' => 'file-text',
                'permission' => 'submit_news_article',
            ],

            [
                'label' => 'Homepage News',
                'route' => 'admin.homepage-news.index',
                'icon' => 'newspaper',
                'permission' => 'manage_homepage_news',
            ],

        ],
    ],

];
