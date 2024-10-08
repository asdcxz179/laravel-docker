<?php

return [

    'verifyKey' => env('VERIFY_KEY', false),

    'lockScreen' => env('LOCK_SCREEN', false),

    'multipleLogin' => env('ADMIN_MULTIPLE_LOGIN', false),

    'logo'  =>  '/asset/images/logo.png',

    'locale'    =>  'zh-Hant',

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin_users',
        ],
        'api' => [
            'driver' => 'sanctum',
            'provider' => 'admin_users',
        ],
    ],

    'users' =>  [
        'model'     =>  Byg\Admin\Models\Admin\User::class,
        'service'   =>  Byg\Admin\Services\Admin\UserService::class,
        'infos'     =>  ["type", "admin_group_id"],
        'form'      =>  [
            'name'  =>  'admin',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'form'  =>  [
                
            ],
            'fields'=>  [
                'account'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'account',
                    'text'          =>  'admin::Admin.admin.account',
                    'placeholder'   =>  'admin::Admin.admin.account',
                    'api_rules'         =>  [
                        'common'    =>  [
                            'max:255',
                        ],
                        'store'     =>  [
                            'required',
                            'unique:admin_users,account',
                        ],
                        'update'    =>  [
                            'nullable',
                            // 'unique:admin_users,account,'.request()->route('id'),
                        ],
                    ],
                    
                ],
                'password'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'password',
                    'name'          =>  'password',
                    'text'          =>  'admin::Admin.admin.password',
                    'placeholder'   =>  'admin::Admin.admin.password',
                    'api_rules'         =>  [
                        'common'    =>  [
                            'string',
                            'between:6,20',
                        ],
                        'store'     =>  [
                            'required',
                            'confirmed',
                        ],
                        'update'    =>  [
                            'nullable',
                            'confirmed',
                        ],
                    ],
                ],
                'name'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'name',
                    'text'          =>  'admin::Admin.admin.name',
                    'placeholder'   =>  'admin::Admin.admin.name',
                    'api_rules'         =>  [
                        'common'    =>  [
                            'required',
                            'max:255',
                        ],
                    ],
                ],
                'status'    =>  [
                    'tag'           =>  'select',
                    'name'          =>  'status',
                    'text'          =>  'admin::Admin.admin.status',
                    'placeholder'   =>  'admin::Admin.admin.status',
                    'api_rules'         =>  [
                        'common'    =>  [
                            'required',
                            'in:0,1',
                        ],
                    ],
                    'options'   =>  [
                        [
                            'value' =>  1,
                            'text'  =>  'admin::Admin.status.enable',
                        ],
                        [
                            'value' =>  0,
                            'text'  =>  'admin::Admin.status.disable',
                        ],
                    ],
                ],
                'admin_group_id'  =>  [
                    'tag'           =>  'select',
                    'name'          =>  'admin_group_id',
                    'text'          =>  'admin::Admin.admin.admin_group_id',
                    'placeholder'   =>  'admin::Admin.admin.admin_group_id',
                    'api_rules'         =>  [
                        'common'    =>  [
                            'required',
                            'exists:admin_groups,id',
                        ],
                    ],
                    'options'   =>  [
                    ],
                ],
            ]
        ],
    ],

    'groups' =>  [
        'model'     =>  Byg\Admin\Models\Admin\Group::class,
        'service'   =>  Byg\Admin\Services\Admin\GroupService::class,
        'form'      =>  [
            'name'  =>  'group',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'form'  =>  [
                
            ],
            'fields'=>  [
                'name'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'name',
                    'text'          =>  'admin::Admin.admin_groups.name',
                    'placeholder'   =>  'admin::Admin.admin_groups.name',
                    'api_rules'         =>  [
                        'common'    =>  [
                            'required',
                            'max:255',
                        ],
                    ],
                ],
                'permissions'   =>  [
                    'tag'           =>  'permission_table',
                    'name'          =>  'permissions',
                    'text'          =>  'admin::Admin.admin_groups.permissions',
                    'placeholder'   =>  'admin::Admin.admin_groups.permissions',
                    'api_rules'         =>  [
                        'common'    =>  [
                            'nullable',
                            'array',
                        ],
                    ],
                ]
            ]
        ],
    ],

    'providers' => [
        'admin_users' => [
            'driver' => 'eloquent',
            'model' => Byg\Admin\Models\Admin\User::class,
        ],
    ],

    'passwords' => [
        'admin_users' => [
            "provider" => "admin_users",
            "table" => "password_resets",
            "expire" => 60,
            "throttle" => 60,
        ],
    ],

    'route' =>  [
        //系統管理
        'Backend.system'  =>  [
            'name'  =>  'admin::Admin.systemManager',
            'icon'  =>  'fa fa-wrench',
            'children'  =>  [
                //系統設定
                'Backend.admin'  =>  [
                    'name'  =>  'admin::Admin.adminManger',
                    'permission'    =>  [
                        'index',
                        'update',
                    ]
                ],
                'Backend.SystemSettings'  =>  [
                    'name'  =>  'admin::Admin.SystemSettings',
                    'permission'    =>  [
                        'index',
                        'store',
                    ]
                ],
            ]
        ]
    ],

    'settings'  =>  [
        'general'   =>  [
            'form'  =>  [
                'name'  =>  'settings',
                'action'=>  '',
                'back'  =>  false,
                'method'=>  "POST",
                'form'  =>  [
                    [
                        'class'  =>  'row',
                        'col'   =>  [
                            [
                                'class' =>  'col-xl-8 col-md-12',
                                'col'   =>  [
                                    [
                                        'class' =>  'row',
                                        'col'   =>  [
                                            [
                                                'class' =>  'col-xl-6 d-none',
                                                'col'   =>  [
                                                    [
                                                        'class' =>  'fields',
                                                        'field' =>  'lang'
                                                    ]
                                                ]
                                            ],
                                            [
                                                'class' =>  'col-xl-6',
                                                'col'   =>  [
                                                    [
                                                        'class' =>  'fields',
                                                        'field' =>  'title'
                                                    ]
                                                ]
                                            ],
                                            [
                                                'class' =>  'col-xl-6',
                                                'col'   =>  [
                                                    [
                                                        'class' =>  'fields',
                                                        'field' =>  'address'
                                                    ],
                                                ],
                                            ],
                                            [
                                                'class' =>  'col-xl-6',
                                                'col'   =>  [
                                                    [
                                                        'class' =>  'fields',
                                                        'field' =>  'service_time'
                                                    ],
                                                ],
                                            ],
                                            [
                                                'class' =>  'col-xl-6',
                                                'col'   =>  [
                                                    [
                                                        'class' =>  'fields',
                                                        'field' =>  'fax'
                                                    ],
                                                ],
                                            ],
                                            [
                                                'class' =>  'col-xl-6',
                                                'col'   =>  [
                                                    [
                                                        'class' =>  'fields',
                                                        'field' =>  'phone'
                                                    ],
                                                ],
                                            ],
                                            [
                                                'class' =>  'col-xl-6',
                                                'col'   =>  [
                                                    [
                                                        'class' =>  'fields',
                                                        'field' =>  'email'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            ],
            'fields'    =>  [
                'lang'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'hidden',
                    'name'          =>  'lang',
                    'text'          =>  '',
                    'placeholder'   =>  '',
                    'rules'         =>  [],
                ],
                'title'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'title',
                    'text'          =>  'admin::Admin.settings.title',
                    'placeholder'   =>  'admin::Admin.settings.title',
                    'rules'         =>  [],
                ],
                'address'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'address',
                    'text'          =>  'admin::Admin.settings.address',
                    'placeholder'   =>  'admin::Admin.settings.address',
                    'rules'         =>  [],
                ],
                'service_time'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'service_time',
                    'text'          =>  'admin::Admin.settings.service_time',
                    'placeholder'   =>  'admin::Admin.settings.service_time',
                    'rules'         =>  [],
                ],
                'fax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'fax',
                    'text'          =>  'admin::Admin.settings.fax',
                    'placeholder'   =>  'admin::Admin.settings.fax',
                    'rules'         =>  [],
                ],
                'phone'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'phone',
                    'text'          =>  'admin::Admin.settings.phone',
                    'placeholder'   =>  'admin::Admin.settings.phone',
                    'rules'         =>  [],
                ],
                'email'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'email',
                    'name'          =>  'email',
                    'text'          =>  'admin::Admin.settings.email',
                    'placeholder'   =>  'admin::Admin.settings.email',
                    'rules'         =>  [],
                ],
            ]
        ]
    ]
];