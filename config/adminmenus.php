<?php
return [
    [
        'name' => '系统设置',
        'id'=> 10000,
        'children' => [
            [
                'id'=> 11000,
                'name' => '登录账号',
                'permissions' => [
                    'backend.admins.index'
                ],
                'children' => [
                    [
                        'id'=> 11100,
                        'name' => '新增',
                        'permissions' => [
                            'backend.admins.store'
                        ]
                    ],
                    [
                        'id'=> 11200,
                        'name' => '编辑',
                        'permissions' => [
                            'backend.admins.show',
                            'backend.admins.update'
                        ]
                    ],
                ]
            ],
            [
                'id'=> 12000,
                'name' => '权限组',
                'permissions' => [
                    'backend.roles.index'
                ],
                'children' => [
                    [
                        'id'=> 12100,
                        'name' => '新增',
                        'permissions' => [
                            'backend.roles.store',
                            'backend.roles.options'
                        ]
                    ],
                    [
                        'id'=> 12200,
                        'name' => '编辑',
                        'permissions' => [
                            'backend.roles.show',
                            'backend.roles.options',
                            'backend.roles.update'
                        ]
                    ],
                    [
                        'id'=> 12300,
                        'name'=> '删除',
                        'permissions'=> [
                            'backend.roles.destroy'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
