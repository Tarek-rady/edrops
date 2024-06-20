<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'owner' => [
            'roles'                       => 'c,r,u,d',
            'admins'                      => 'c,r,u,d',
            'sallers'                     => 'c,r,u,d',
            'pulls'                       => 'c,r,u,d',
            'profits'                     => 'c,r,u,d',
            'users'                       => 'c,r,u,d',
            'banners'                     => 'c,r,u,d',
            'countries'                   => 'c,r,u,d',
            'cities'                      => 'c,r,u,d',
            'news'                        => 'c,r,u,d',
            'categories'                  => 'c,r,u,d',
            'brands'                      => 'c,r,u,d',
            'products'                    => 'c,r,u,d',
            'orders'                      => 'c,r,u,d',
            'statics'                     => 'c,r,u,d',
            'reports'                     => 'c,r,u,d',
            'feautures'                   => 'c,r,u,d',
            'steps'                       => 'c,r,u,d',
            'terms'                       => 'c,r,u,d',
            'contents'                    => 'c,r,u,d',
            'asks'                        => 'c,r,u,d',
            'rates'                       => 'c,r,u,d',
            'contact_us'                  => 'r,d',
            'stocks'                      => 'c,r,u,d',
            'currencies'                      => 'c,r,u,d',
            'payout_requests'             => 'c,r,u,d',
            'profitApps'                  => 'r' ,
            'settings'                    => 'r,u',
            'statistics'                  => 'r',




        ],

        'admin' => [] ,
        'user' => [] ,


    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ],

    'roles_structure_arabic' => [
        'superadmin'    => 'مشرف عام',
        'admin'         => 'مشرف',
        'user'          => 'مستخدم'
    ],

    'roles_structure_color' => [
        'superadmin'    => '#F00',
        'admin'         => '#00F',
        'user'          => '#080'
    ],
];
