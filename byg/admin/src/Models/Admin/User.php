<?php

namespace Byg\Admin\Models\Admin;

class User extends \Byg\Admin\Models\Universal\UserModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes,
        Yadahan\AuthenticationLog\AuthenticationLogable,
        \Spatie\Permission\Traits\HasPermissions;

    protected $table = "admin_users";
    protected $fillable = [
        'name',
        'account',
        'password',
        'status',
    ];
    protected $appends = [
        'login_count',
        'last_login_time'
    ];
    protected $hidden = [
        'info','lastLogin',
    ];

    public function info() {
        return $this->hasMany(UsersInfo::class,'user_id','id')->where("key","!=","token");
    }

    public function getLoginCountAttribute() {
        return $this->info->pluck('value','key')['login_count']??0;
    }

    public function getTypeAttribute() {
        return $this->info->pluck('value','key')['type']??"";
    }

    public function getLastLoginTimeAttribute() {
        return ($this->lastLogin)?$this->lastLogin->login_at->toDateTimeString():'';
    }

    public function lastLogin() {
        return $this->hasOne('Yadahan\AuthenticationLog\AuthenticationLog','authenticatable_id')->orderBy('login_at', 'desc')->select('authenticatable_id','login_at');
    }

    public function isSuperAdmin(){
        return $this->hasOne(UsersInfo::class,'user_id','id')->where("key","=","type")->first()->value==1;
    }

    /** 
     * @access protected
     * @var detail
     * @version 1.0
     * @author Henry
    **/
    protected $detail = ["name","email","id","status","created_at"];

    /**
     * 列表SQL
     * @param  array $where
     * @return $query
     * @version 1.0
     * @author Henry
     */
    public function listQuery(array $where) {
        $query = parent::listQuery($where)->whereDoesntHave('info', function($query) {
            $query->where('key','type')->where('value','admin');
        });
        return $query;
    }

    public function authentications()
    {
        return $this->morphMany(\Yadahan\AuthenticationLog\AuthenticationLog::class, 'authenticatable');
    }
}
