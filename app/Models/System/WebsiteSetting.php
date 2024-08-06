<?php

namespace App\Models\System;

class WebsiteSetting extends \Byg\Admin\Models\Universal\Model
{
    protected $table = 'website_settings';

    protected $fillable = [
        'website_id',
        'key',
        'value',
    ];
    
}
