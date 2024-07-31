<?php

namespace Byg\Admin\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Byg\Admin\Http\Responses\Api\Response;
use Byg\Admin\Services\Admin\UserService;
use Byg\Admin\Http\Requests\Admin\Auth\PasswordRequest;
/**
 *  @OA\Post (
 *      path="/admin/password",
 *      tags={"Auth"},
 *      summary="管理員變更密碼",
 *      description="管理員變更密碼",
 *      security={{"sanctum":{}}},
 *      @OA\Parameter(
 *          name="X-Requested-With",
 *          in="header",
 *          required=true,
 *          @OA\Schema(
 *              type="string",
 *              default="XMLHttpRequest"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"old_password","password", "password_confirmation"},
 *              @OA\Property(property="old_password", type="string", example="123qwe", description="舊密碼"),
 *              @OA\Property(property="password", type="string", example="123qwe", description="新密碼"),
 *              @OA\Property(property="password_confirmation", type="string", example="123qwe", description="確認密碼"),
 *          )
 *      ),
 *      @OA\Response(
 *          response="200",
 *          description="成功",
 *          @OA\JsonContent(
 *              example={
 *                  "status":200,
 *                  "message":"success",
 *                  "data":{
 *                  }
 *              }
 *          )
 *      )
 *  )
 * 
 */
class PasswordController extends Controller
{
    /** 
     * \App\Services\Admin\UserService
     * @access protected
     * @var UserService
     * @version 1.0
     * @author Henry
    **/
    protected $UserService;
    
    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct(UserService $UserService) {
        $this->UserService = $UserService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Byg\Admin\Http\Responses\Api\Response
     */
    public function store(PasswordRequest $request)
    {
        $this->UserService->updatePassword($request->all(), auth()->user()->id);
        if($request->ajax()) {
            return Response::json(['message' => __('admin::Admin.admin.passwordChangeSuccess')]);
        }
        return back();
    }

}