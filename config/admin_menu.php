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
        ],
    ],

];