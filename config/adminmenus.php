<?php
return [
    [
        'name' => '系统设置',
        'id'=> 1,
        'children' => [
            [
                'id'=> 2,
                'name' => '管理员',
                'permissions' => [
                    'admins.index'
                ],
                'children' => [
                    [
                        'id'=> 3,
                        'name' => '新增',
                        'permissions' => [
                            'admins.store'
                        ]
                    ],
                    [
                        'id'=> 4,
                        'name' => '编辑',
                        'permissions' => [
                            'admins.show',
                            'admins.update'
                        ]
                    ],
                ]
            ],
            [
                'name'=> '商品管理',
                'id'=> 5,
                'children' => [
                    [
                        'id'=> 6,
                        'name'=> '商品列表',
                        'permissions'=> [
                            'product.index'
                        ],
                        'children'=> [
                            [
                                'id'=>7,
                                'name'=>'创建',
                                'permissions'=> [
                                    'product.store'
                                ]
                            ],
                            [
                                'id'=> 8,
                                'name'=>'编辑',
                                'permissions'=> [
                                    'product.update'
                                ]
                            ]
                        ]
                    ],
                    [
                        'id'=> 9,
                        'name'=> '分类管理',
                        'permission'=> [
                            'class.index'
                        ],
                        'children'=> [
                            [
                                'id'=> 10,
                                'name'=>'创建',
                                'permissions'=> [
                                    'class.store'
                                ]
                            ],
                            [
                                'id'=> 11,
                                'name'=>'编辑',
                                'permissions'=> [
                                    'class.update'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
