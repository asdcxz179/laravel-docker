<?php

namespace App\Models\System;


class Website extends \Byg\Admin\Models\Universal\Model
{
    protected $table = 'websites';

    protected $fillable = [
        'name',
        'prefix',
        'front_domain',
        'backend_domain',
        'status',
        'online_date',
    ];

    public function settings() {
        return $this->hasMany(WebsiteSetting::class);
    }
}
