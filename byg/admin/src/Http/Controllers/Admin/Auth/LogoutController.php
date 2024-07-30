<?php

namespace Byg\Admin\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Byg\Admin\Http\Responses\Api\Response;
use Byg\Admin\Services\Admin\UserService;
use Illuminate\Http\Request;

class LogoutController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \App\Http\Responses\Universal\ApiResponse
     */
    public function index(Request $request)
    {
        $this->UserService->logout($request->ip(),$request->userAgent());
        if($request->ajax()) {
            return Response::json(["message"=>__('admin::Admin.logoutSuccess')]);
        }
        return redirect()->route('Backend.Login.index');
    }
}