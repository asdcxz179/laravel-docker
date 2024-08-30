<?php

namespace Byg\Admin\Models\Admin;

class Group extends \Byg\Admin\Models\Universal\Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    /**
     * 資料表名稱
     *
     * @var string
     */
    protected $table = "admin_groups";

    protected $casts = [
        'permissions' => 'json'
    ];
        
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'permissions'
    ];

    /** 
     * @access protected
     * @var detail
     * @version 1.0
     * @author Henry
    **/
    protected $detail = [
        "id",
        "name",
        "status",
        "permissions",
        "created_at"
    ];
    
}
