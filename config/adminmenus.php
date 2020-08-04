<?php
return [
    [
        'name' => '系统设置',
        'id' => 10000,
        'children' => [
            [
                'id' => 11000,
                'name' => '系统账号',
                'children' => [
                    [
                        'id' => 11100,
                        'name' => '账号列表',
                        'permissions' => [
                            'App\Http\Controllers\Backend\AdminController@index'
                        ],
                        'children' => [
                            [
                                'id' => 11110,
                                'name' => '新增',
                                'permissions' => [
                                    'App\Http\Controllers\Backend\AdminController@store',
                                    'App\Http\Controllers\Backend\AdminController@options'
                                ]
                            ],
                            [
                                'id' => 11120,
                                'name' => '编辑',
                                'permissions' => [
                                    'App\Http\Controllers\Backend\AdminController@show',
                                    'App\Http\Controllers\Backend\AdminController@update',
                                    'App\Http\Controllers\Backend\AdminController@options'
                                ]
                            ],
                            [
                                'id' => 11130,
                                'name' => '重置密码',
                                'permissions' => [
                                    'App\Http\Controllers\Backend\AdminController@password'
                                ]
                            ],
                        ]
                    ],
                    [
                        'id' => 11200,
                        'name' => '操作记录',
                        'permissions' => [
                            'App\Http\Controllers\Backend\AdminActionLogController@index'
                        ]
                    ],
                ]
            ],
            [
                'id' => 12000,
                'name' => '权限组',
                'permissions' => [
                    'App\Http\Controllers\Backend\RoleController@index',
                ],
                'children' => [
                    [
                        'id' => 12100,
                        'name' => '新增',
                        'permissions' => [
                            'App\Http\Controllers\Backend\RoleController@store',
                            'App\Http\Controllers\Backend\RoleController@options',
                        ]
                    ],
                    [
                        'id' => 12200,
                        'name' => '编辑',
                        'permissions' => [
                            'App\Http\Controllers\Backend\RoleController@show',
                            'App\Http\Controllers\Backend\RoleController@options',
                            'App\Http\Controllers\Backend\RoleController@update',
                        ]
                    ],
                    [
                        'id' => 12300,
                        'name' => '删除',
                        'permissions' => [
                            'App\Http\Controllers\Backend\RoleController@destroy',
                        ]
                    ],
                ]
            ],
            [
                'id' => 13000,
                'name' => '运维',
                'children' => [
                    [
                        'id' => 13100,
                        'name' => '前端异常列表',
                        'permissions' => [
                            'App\Http\Controllers\Backend\FrontendErrorController@index',
                        ],
                        'children' => [
                            [
                                'id' => 13110,
                                'name' => '全部清除',
                                'permissions' => [
                                    'App\Http\Controllers\Backend\FrontendErrorController@flush',
                                ]
                            ],
                        ]
                    ],
                    [
                        'id' => 13200,
                        'name' => '队列面板',
                        'permissions' => [
                            'queue',
                        ],
                    ],
                    [
                        'id' => 13300,
                        'name' => '后端路由',
                        'permissions' => [
                            'App\Http\Controllers\Backend\RouteController@index',
                        ],
                    ],
                    [
                        'id' => 13400,
                        'name' => 'redis',
                        'permissions' => [
                            'App\Http\Controllers\Backend\SystemController@redis',
                        ],
                    ]
                ]
            ],
            [
                'id' => 14000,
                'name' => '系统日志',
                'permissions' => [
                    'App\Http\Controllers\Backend\SystemLogController@index',
                    'App\Http\Controllers\Backend\SystemLogController@content',
                ],
                'children' => [
                    [
                        'id' => 14100,
                        'name' => '删除日志文件',
                        'permissions' => [
                            'App\Http\Controllers\Backend\SystemLogController@destroy',
                        ]
                    ]
                ]
            ]
        ]
    ]
];
