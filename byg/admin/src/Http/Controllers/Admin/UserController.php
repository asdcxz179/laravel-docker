<?php

namespace Byg\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Byg\Admin\Http\Responses\Api\Response;
use Illuminate\Support\Facades\Gate;
/**
 *  @OA\Get (
 *      path="/admin/users?draw={draw}&start={start}&length={length}",
 *      tags={"Admin"},
 *      summary="管理員列表",
 *      description="管理員列表",
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
 *      @OA\Parameter(
 *          name="draw",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              default=1
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="start",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              default=0
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="length",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              default=10
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
 *                      "exception": null,
 *                      "headers":{},
 *                      "original":{
 *                          "draw":1,
 *                          "recordsTotal":1,
 *                          "recordsFiltered":1,
 *                          "data":{
 *                              {
 *                                  "id":1,
 *                                  "name":"admin",
 *                                  "account":"admin",
 *                                  "status":1,
 *                                  "created_at":"2021-07-01 00:00:00",
 *                                  "login_count":1,
 *                                  "last_login_time":"2021-07-01 00:00:00",
 *                                  "group":{
 *                                      "id":1,
 *                                      "name":"admin",
 *                                      "permissions": "[]"
 *                                  }                  
 *                              }
 *                          }
 *                      }
 *                  }
 *             }
 *         ) 
 *      )
 *  )
 * )
 *  @OA\Get (
 *      path="/admin/users/{id}",
 *      tags={"Admin"},
 *      summary="管理員詳細資料",
 *      description="管理員詳細資料",
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
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              default=2
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
 *                      "id":1,
 *                      "name":"admin",
 *                      "account":"admin",
 *                      "status":1,
 *                      "created_at":"2021-07-01 00:00:00",
 *                      "login_count":1,
 *                      "last_login_time":"2021-07-01 00:00:00",
 *                      "group":{
 *                          "id":1,
 *                          "name":"admin",
 *                          "permissions": "[]"
 *                      }
 *                  }
 *              }
 *          )
 *      )
 *  ),
 * 
 * @OA\Post (
 *      path="/admin/users",
 *      tags={"Admin"},
 *      summary="新增管理員",
 *      description="新增管理員",
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
 *              required={"name","account","password","status"},
 *              @OA\Property(property="name", type="string", example="test", description="名稱"),
 *              @OA\Property(property="account", type="string", example="test", description="帳號"),
 *              @OA\Property(property="password", type="string", example="123qwe", description="密碼"),
 *              @OA\Property(property="password_confirmation", type="string", example="123qwe", description="確認密碼"),
 *              @OA\Property(property="status", type="integer", example="1", description="狀態"),
 *          )
 *     ),
 *     @OA\Response(
 *          response="200",
 *          description="成功",
 *          @OA\JsonContent(
 *              example={
 *                  "status":200,
 *                  "message":"新增成功"
 *              }
 *          )
 *    )
 * )
 * @OA\Put (
 *      path="/admin/users/{id}",
 *      tags={"Admin"},
 *      summary="修改管理員",
 *      description="修改管理員",
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
  *      @OA\Parameter(
 *          name="id",
 *          description="管理員ID",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name","account","password","status"},
 *              @OA\Property(property="name", type="string", example="test", description="名稱"),
 *              @OA\Property(property="password", type="string", example="", description="密碼"),
 *              @OA\Property(property="password_confirmation", type="string", example="", description="確認密碼"),
 *              @OA\Property(property="status", type="integer", example="1", description="狀態"),
 *          )
 *     ),
 *     @OA\Response(
 *          response="200",
 *          description="成功",
 *          @OA\JsonContent(
 *              example={
 *                  "status":200,
 *                  "message":"修改成功"
 *              }
 *          )
 *    )
 * )
 * 
 * @OA\Delete (
 *      path="/admin/users/{id}",
 *      tags={"Admin"},
 *      summary="刪除管理員",
 *      description="刪除管理員",
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
  *      @OA\Parameter(
 *          name="id",
 *          description="管理員ID",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response="200",
 *          description="成功",
 *          @OA\JsonContent(
 *              example={
 *                  "status":200,
 *                  "message":"刪除成功"
 *              }
 *          )
 *      )
 *  )
 * 
 */
class UserController extends Controller
{
    protected $UserService;

    protected $GroupService;

    public function __construct() {
        $this->UserService = app(config('admin.users.service'));
        $this->GroupService = app(config('admin.groups.service'));
    }

    
    /**
     * 管理員列表
     *
     * @return void
     */
    public function index()
    {
        Gate::authorize('view', new \Byg\Admin\Models\Admin\User());
        return Response::json(["data" => $this->UserService->index(request()->all())]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('view', new \Byg\Admin\Models\Admin\User());
        $fields = config('admin.users.form.fields');
        $fields['admin_group_id']['options'] = $this->GroupService->select();
        return Response::json([
            "data"  =>  collect($fields)->values()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Byg\Admin\Http\Requests\Admin\StoreRequest $request)
    {
        Gate::authorize('create', new \Byg\Admin\Models\Admin\User());
        $this->UserService->store($request->all());
        if($request->ajax()) {
            return Response::json(["message"=>__('admin::Admin.success.insertSuccess')]);
        }else{
            return redirect()->route('Backend.admin.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('view', new \Byg\Admin\Models\Admin\User());
        if(request()->ajax()) {
            return Response::json(["data"=>$this->UserService->getUser($id) ]);
        }
        $user = $this->UserService->getUser($id);
        $data['user']   =   $user;
        return view('admin::admin.detail',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Byg\Admin\Http\Requests\Admin\UpdateRequest $request, string $id)
    {
        Gate::authorize('update', new \Byg\Admin\Models\Admin\User());
        $this->UserService->update($request->all(),$id);
        if($request->ajax()) {
            return Response::json(["message"=>__('admin::Admin.success.updateSuccess')]);
        }else{
            return redirect()->route('Backend.admin.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete', new \Byg\Admin\Models\Admin\User());
        $this->UserService->delete($id);
        return Response::json(["message"=>__('admin::Admin.success.deleteSuccess')]);
    }
}
