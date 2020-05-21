<?php
return [
    [
        'name' => '系统设置',
        'id'=> 10000,
        'children' => [
            [
                'id'=> 11000,
                'name'=> '系统账号',
                'children' => [
                    [
                        'id'=> 11100,
                        'name' => '账号列表',
                        'permissions' => [
                            'backend.admins.index'
                        ],
                        'children' => [
                            [
                                'id'=> 11110,
                                'name' => '新增',
                                'permissions' => [
                                    'backend.admins.store'
                                ]
                            ],
                            [
                                'id'=> 11120,
                                'name' => '编辑',
                                'permissions' => [
                                    'backend.admins.show',
                                    'backend.admins.update'
                                ]
                            ],
                            [
                                'id'=> 11130,
                                'name'=> '重置密码',
                                'permissions'=> [
                                    'backend.admins.password'
                                ]
                            ],
                        ]
                    ],
                    [
                        'id' => 11200,
                        'name'=> '操作记录',
                        'permissions'=> [
                            'backend.admin-action-logs.index'
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
                    ],
                ]
            ],
            [
                'id'=> 13000,
                'name'=> '运维',
                'children' => [
                    [
                        'id'=> 13100,
                        'name'=> '前端异常列表',
                        'permissions' => ['backend.frontend-errors.index'],
                        'children' => [
                            [
                                'id'=> 13110,
                                'name'=> '全部清除',
                                'permissions' => [
                                    'backend.frontend-errors.flush'
                                ]
                            ],
                        ]
                    ],
                    [
                        'id'=> 13200,
                        'name'=> '队列面板',
                        'permissions' => ['backend.queues.index'],
                    ]
                ]
            ]
        ]
    ]
];
