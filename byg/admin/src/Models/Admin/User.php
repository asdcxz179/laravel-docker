<?php

namespace Byg\Admin\Models\Admin;

class User extends \Byg\Admin\Models\Universal\UserModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes,
        \Yadahan\AuthenticationLog\AuthenticationLogable,
        \Spatie\Permission\Traits\HasPermissions,
        \Laravel\Sanctum\HasApiTokens;
    
    /**
     * 資料表名稱
     *
     * @var string
     */
    protected $table = "admin_users";
        
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'account',
        'password',
        'status',
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
        "account",
        "status",
        "created_at"
    ];
    
    /**
     * appends
     *
     * @var array
     */
    protected $appends = [
        'login_count',
        'last_login_time',
        'group',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = [
        'info',
        'lastLogin',
    ];

    protected $super = 'admin';
    
    /**
     * 關聯管理員資訊
     *
     * @return void
     */
    public function info() {
        return $this->hasMany(UserInfo::class,'admin_user_id','id')->where("key","!=","token");
    }

    public function getGroupAttribute() {
        return $this->info()->where('key', 'admin_group_id')->first()?->group;
    }
    
    /**
     * 取得登入次數
     *
     * @return void
     */
    public function getLoginCountAttribute() {
        return $this->info->pluck('value','key')['login_count']??0;
    }
    
    /**
     * 取得帳號類型
     *
     * @return void
     */
    public function getTypeAttribute() {
        return $this->info->pluck('value','key')['type']??"";
    }
    
    /**
     * 取得最後登入時間
     *
     * @return void
     */
    public function getLastLoginTimeAttribute() {
        return ($this->lastLogin)?$this->lastLogin->login_at->toDateTimeString():'';
    }
    
    /**
     * 關聯取得最後時間
     *
     * @return void
     */
    public function lastLogin() {
        return $this->hasOne('Yadahan\AuthenticationLog\AuthenticationLog','authenticatable_id')->orderBy('login_at', 'desc')->select('authenticatable_id','login_at');
    }
    
    /**
     * 是否為超級管理員
     *
     * @return boolean
     */
    public function isSuperAdmin(){
        return $this->hasOne(UserInfo::class,'admin_user_id','id')->where("key", "type")->first()?->value == $this->super;
    }

    /**
     * 列表SQL
     * @param  array $where
     * @return $query
     * @version 1.0
     * @author Henry
     */
    public function listQuery(array $where) {
        $query = parent::listQuery($where)->whereDoesntHave('info', function($query) {
            $query->where('key','type')->where('value', $this->super);
        });
        return $query;
    }

    public function authentications()
    {
        return $this->morphMany(\Yadahan\AuthenticationLog\AuthenticationLog::class, 'authenticatable');
    }
}
