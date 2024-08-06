<?php

namespace Byg\Admin\Services\Admin;

use Illuminate\Support\Arr;
use Byg\Admin\Exceptions\Api\ErrorException;
use Illuminate\Support\Facades\Hash;
use Auth;
use DataTables;
use Illuminate\Auth\Events\Login;

/**
 * Class UserService.
 */
class UserService
{
    /** 
     * \App\Repositories\Admin\UsersRepository
     * @access protected
     * @var UsersRepository
     * @version 1.0
     * @author Henry
    **/
    protected $UsersRepository;

    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct() {
        $this->UsersRepository = app(config('admin.users.model'));
    }

    /**
     * 使用者列表
     * @param array $data
     * @version 1.0
     * @author Henry
     * @return \DataTables
     */
    public function index($data) {
        $where = Arr::only($data,["name","email","status"]);
        return DataTables::of($this->UsersRepository->listQuery($where))->make();
    }

    /**
     * 使用者登入记录列表
     * @param array $data
     * @version 1.0
     * @author Henry
     * @return \DataTables
     */
    public function loginRecordList($id) {
        $user = $this->getUser($id);
        return DataTables::of($user->authentications())->make();
    }

    /**
     * 取得單一使用者資料
     * @param string $uuid
     * @return object
     * @version 1.0
     * @author Henry
     */
    public function getUser(string $uuid) {
        return $this->UsersRepository->getDetail($uuid);
    }

    /**
     * 建立使用者
     * @param array $data
     * @return object $user
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function store(array $data) {
        return \DB::transaction(function() use ($data) {
            $createData = Arr::only($data, array_merge(['password'], $this->UsersRepository->getDetailFields()));
            $createData['password'] = $this->MakePassword($createData['password']);
            $createData['status'] = 1;
            $user     =   $this->UsersRepository->create($createData);
            if(!$user){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.insertFail')]],__('admin::Admin.error.insertFail'),500);
            }
            $result = $this->updateInfo($user, $data);
            if(!$result){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.insertFail')]],__('admin::Admin.error.insertFail'),500);
            }
            return $user;
        });
    }

    /**
     * 更新使用者資料
     * @param array $data
     * @param string $uuid
     * @return object $user
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function update(array $data, string $uuid) {
        return \DB::transaction(function() use ($data, $uuid) {
            $fields = array_merge(['password'], $this->UsersRepository->getDetailFields());
            unset($fields['account']);
            $updateData = array_filter(Arr::only($data, $fields),'strlen');
            if(isset($data['password']) && $data['password']){
                $updateData['password'] =   $this->MakePassword($data['password']);
            }
            $model =  $this->UsersRepository->find($uuid);
            $user = $model->update($updateData);
            if(!$user){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.updateFail')]],__('admin::Admin.error.updateFail'),500);
            }
            $result = $this->updateInfo($model, $data);
            if(!$result){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.updateFail')]],__('admin::Admin.error.updateFail'),500);
            }
            return $user;
        });
    }

    /**
     * 刪除使用者
     * @param string $uuid
     * @return object $user
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function delete(string $uuid) {
        $user = $this->UsersRepository->find($uuid)->delete();
        if(!$user){
            throw new ErrorException(['data' => ['error' => __('admin::Admin.error.deleteFail')]],__('admin::Admin.error.deleteFail'),500);
        }
        return $user;
    }

    /**
     * 密碼加密
     * @param string $password
     * @return string 
     * @version 1.0
     * @author Henry
     */    
    public function MakePassword(String $password) {
        return Hash::make($password);
    }
    
    /**
     * 使用者登入
     * @param  array $request
     * @param  string $ip
     * @param  string $userAgent
     * @return array
     */
    public function login(array $request,string $ip,string $userAgent) {
        $credentials = Arr::only($request,["account","password"]);
        if(env("AUTH_MODE") == "token") {
            $user = $this->UsersRepository->where([
                'account' => $credentials['account'],
                'status' => 1
            ])->first();
            if(!$user || !Hash::check($credentials['password'],$user->password)) {
                throw new ErrorException(['data'=>['error'=>__('admin::Admin.error.accountOrPasswordError')]],__('admin::Admin.error.accountOrPasswordError'),401);
            }
            event(new Login(config('auth.defaults.guard'), $user, false));
        }else{
            if (! $token = auth()->attempt(array_merge($credentials,['status' => 1]))) {
                throw new ErrorException(['data'=>['error'=>__('admin::Admin.error.accountOrPasswordError')]],__('admin::Admin.error.accountOrPasswordError'),401);
            }
            $user = auth()->user();
        }

        $return =   [
            'avatar'    =>  '',
            'nickname'  =>  $user->name,
            'username'  =>  $user->account,
            'roles'     =>  [
                'admin'
            ],
        ];
        
        if(env("AUTH_MODE") == "token") {
            $token = $user->createToken($userAgent)->plainTextToken;
            $return['accessToken'] = $token;
            $return['refreshToken'] = '';
            $return['expires'] = 0;
        }
        if(env("ADMIN_MUTIPLE_LOGIN",false)) {
            Auth::logoutOtherDevices($credentials['password']);
        }
        
        return $return;
    }
    
    /**
     * 使用者登出
     *
     * @param  string $ip
     * @param  string $userAgent
     * @return void
     */
    public function logout(string $ip,string $userAgent) {
        if(env("AUTH_MODE") == "token") {
            auth()->user()->tokens()->where('name', $userAgent)->delete();
        }else{
            $user_id    =   auth()->user()->id;
            auth()->logout();
        }
        
        // if(!$result){
        //     throw new ErrorException(['data'=>['error'=>__('admin::Admin.error.serverError')]],__('admin::Admin.error.serverError'),500);
        // }
    }
    
    /**
     * 建立更新使用者資訊
     * @param  mixed $user
     * @param  mixed $data
     * @return boolean
     */
    public function updateInfo($user, array $data) {
        $info = ["type"];
        foreach(Arr::only($data,$info) as $key => $value){
            $result = $user->info()->updateOrCreate(["key" => $key],["value" => $value]);
            if(!$result) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * 變更密碼
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updatePassword(array $data, string $id) {
        $updateData = Arr::only($data,['password']);
        $user = $this->UsersRepository->find($id);
        if(!Hash::check($data['old_password'],$user->password)) {
            throw new ErrorException(['data'=>['error'=>__('admin::Admin.error.oldPasswordError')]],__('admin::Admin.error.oldPasswordError'),422);
        }
        if(isset($data['password']) && $data['password']){
            $updateData['password'] =   $this->MakePassword($data['password']);
        }
        $result =  $user->update($updateData);
        if(!$result){
            throw new ErrorException(['data' => ['error' => __('admin::Admin.error.updateFail')]],__('admin::Admin.error.updateFail'),500);
        }
    }

}