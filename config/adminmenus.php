<?php
return [
    [
        'name' => '系统设置',
        'id'=> 10000,
        'children' => [
            [
                'id'=> 14000,
                'name'=> 'dashboard',
                'permissions' => [
                    'Backend.system-dashboard.index'
                ]
            ],
            [
                'id'=> 11000,
                'name'=> '系统账号',
                'children' => [
                    [
                        'id'=> 11100,
                        'name' => '账号列表',
                        'permissions' => [
                            'Backend.admins.index'
                        ],
                        'children' => [
                            [
                                'id'=> 11110,
                                'name' => '新增',
                                'permissions' => [
                                    'Backend.admins.store'
                                ]
                            ],
                            [
                                'id'=> 11120,
                                'name' => '编辑',
                                'permissions' => [
                                    'Backend.admins.show',
                                    'Backend.admins.update'
                                ]
                            ],
                            [
                                'id'=> 11130,
                                'name'=> '重置密码',
                                'permissions'=> [
                                    'Backend.admins.password'
                                ]
                            ],
                        ]
                    ],
                    [
                        'id' => 11200,
                        'name'=> '操作记录',
                        'permissions'=> [
                            'Backend.admin-action-logs.index'
                        ]
                    ],
                ]
            ],
            [
                'id'=> 12000,
                'name' => '权限组',
                'permissions' => [
                    'Backend.roles.index'
                ],
                'children' => [
                    [
                        'id'=> 12100,
                        'name' => '新增',
                        'permissions' => [
                            'Backend.roles.store',
                            'Backend.roles.options'
                        ]
                    ],
                    [
                        'id'=> 12200,
                        'name' => '编辑',
                        'permissions' => [
                            'Backend.roles.show',
                            'Backend.roles.options',
                            'Backend.roles.update'
                        ]
                    ],
                    [
                        'id'=> 12300,
                        'name'=> '删除',
                        'permissions'=> [
                            'Backend.roles.destroy'
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
                        'permissions' => ['Backend.frontend-errors.index'],
                        'children' => [
                            [
                                'id'=> 13110,
                                'name'=> '全部清除',
                                'permissions' => [
                                    'Backend.frontend-errors.flush'
                                ]
                            ],
                        ]
                    ],
                    [
                        'id'=> 13200,
                        'name'=> '队列面板',
                        'permissions' => ['Backend.queues.index'],
                    ]
                ]
            ]
        ]
    ]
];
