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
                ],
                'prefix'    =>  [
                    "label" =>  "websites.prefix",
                    "prop"  =>  "prefix",
                    "valueType" =>  "copy",
                ],
                'front_domain'  =>  [
                    "label" =>  "websites.front_domain",
                    "prop"  =>  "front_domain",
                    "valueType" =>  "copy",
                ],
                'backend_domain'   =>  [
                    "label" =>  "websites.backend_domain",
                    "prop"  =>  "back_domain",
                    "valueType" =>  "copy",
                ],
                'status'    =>  [
                    "label" =>  "websites.status",
                    "prop"  =>  "status",
                    "valueType" =>  "select",
                ],
                'online_date'   =>  [
                    "label" =>  "websites.online_date",
                    "prop"  =>  "online_date",
                    "valueType" =>  "time",
                ],
            ]
        ]
    ];