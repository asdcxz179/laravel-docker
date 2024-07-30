<?php

namespace Byg\Admin\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Byg\Admin\Http\Requests\Admin\Auth\LoginRequest;
use Byg\Admin\Services\Admin\UserService;
use Byg\Admin\Http\Responses\Api\Response;

/**
 * @OA\Post (
 *     path="/admin/login",
 *    tags={"Auth"},
 *   summary="管理員登入",
 * description="管理員登入",
 * @OA\RequestBody(
 *    required=true,
 *   @OA\JsonContent(
 *     required={"account","password"},
 *   @OA\Property(property="account", type="string", example="admin", description="帳號"),
 *  @OA\Property(property="password", type="string", example="admin", description="密碼"),
 * )
 * ),
 * @OA\Response(
 *   response="200",
 * description="成功",
 * @OA\JsonContent(
 *  example={
 *   "status":200,
 * "message":"success",
 * "data":{
 * "exception": null,
 * "headers":
 * {},
 * "original":{
 * "token":"eyJ
 *  0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIwMjEtMDctMjBUMDk6MzA6MjQuMjYwMjIwMjIiLCJpYXQiOjE2MjQ2MjIwMjIsImV4cCI6MTYyNDYyNTYyMiwiYXVkIjoiIiwic3ViIjoiIiwic2NvcGVzIjpbXX0",
 * "token_type":"Bearer",
 * "expires_in":3600,
 * "user":{
 * "id":1,
 * "name":"admin",
 * "account":"admin",
 * "status":1,
 * "created_at":"2021-07-01 00:00:00",
 * "login_count":1,
 * "last_login_time":"2021-07-01 00:00:00"
 * }
 * }
 * }
 * }
 * )
 * )
 * )
 * 
 */
class LoginController extends Controller
{
    /**
     * \App\Services\Admin\UserService
     * @access protected
     * @var UserService
     * @version 1.0
     * @author Henry
     */
    protected $UserService;

    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct(UserService $UserService){
        $this->UserService = $UserService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        $data = $this->UserService->login($request->all(),$request->ip(),$request->userAgent());
        if($request->ajax()) {
            return Response::json(["message"=>__('admin::Admin.loginSuccess'), "data" => $data]);
        }
        return redirect()->route('Backend.dashboard.index');
    }

}
