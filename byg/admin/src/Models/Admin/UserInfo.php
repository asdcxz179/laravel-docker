<?php

namespace Byg\Admin\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends \Byg\Admin\Models\Universal\Model
{    
    /**
     * 資料表名稱
     *
     * @var string
     */
    protected $table = 'admin_user_infos';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'admin_user_id',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = [
        "admin_user_id",
    ];
}
