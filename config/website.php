<?php

    return [
        'model'     =>  \App\Models\System\Website::class,
        'service'   =>  \App\Services\System\WebsiteService::class,
        'settings'  =>  [
            
        ],
        'form'  =>  [
            'name'  =>  'website',
            'action'    =>  '',
            'back'  =>  '',
            'method'    =>  'POST',
            'fields'    =>  [
                'name'  =>  [
                    "label" =>  "websites.name",
                    "prop"  =>  "name",
                    "valueType" =>  "copy",
                    "labelWidth"    =>  "100px",
                    "rules" =>  [
                        [
                            "required"  =>  true,
                            "trigger"   =>  "blur"
                        ]
                    ]
                ],
                'prefix'    =>  [
                    "label" =>  "websites.prefix",
                    "prop"  =>  "prefix",
                    "valueType" =>  "copy",
                    "labelWidth"    =>  "100px",
                    "rules" =>  [
                        [
                            "required"  =>  true,
                            "trigger"   =>  "blur"
                        ]
                    ]
                ],
                'front_domain'  =>  [
                    "label" =>  "websites.front_domain",
                    "prop"  =>  "front_domain",
                    "labelWidth"    =>  "100px",
                    "valueType" => "copy",
                    "rules" =>  [
                        [
                            "required"  =>  true,
                            "trigger"   =>  "blur"
                        ]
                    ]
                ],
                'backend_domain'   =>  [
                    "label" =>  "websites.backend_domain",
                    "prop"  =>  "backend_domain",
                    "labelWidth"    =>  "100px",
                    "valueType" => "copy",
                    "rules" =>  [
                        [
                            "required"  =>  true,
                            "trigger"   =>  "blur"
                        ]
                    ]
                ],
                'status'    =>  [
                    "label" =>  "websites.status",
                    "prop"  =>  "status",
                    "valueType" =>  "select",
                    "labelWidth"    =>  "100px",
                    "options"   =>  [
                        [
                            "label" =>  "websites.statuses.0",
                            "value" =>  0,
                            "color" =>  "gray"
                        ],
                        [
                            "label" =>  "websites.statuses.1",
                            "value" =>  1,
                            "color" =>  "green"
                        ],
                        [
                            "label" =>  "websites.statuses.2",
                            "value" =>  2,
                            "color" =>  "warning"
                        ],
                        [
                            "label" =>  "websites.statuses.3",
                            "value" =>  3,
                            "color" =>  "red"
                        ]
                    ],
                    "rules" =>  [
                        [
                            "required"  =>  true,
                            "trigger"   =>  "blur"
                        ]
                    ]
                ],
                'online_date'   =>  [
                    "label"     =>  "websites.online_date",
                    "prop"      =>  "online_date",
                    "valueType" =>  "date-picker",
                    "labelWidth"=>  "100px",
                    "valueFormat"   =>  "YYYY-MM-DD",
                ],
            ]
        ]
    ];