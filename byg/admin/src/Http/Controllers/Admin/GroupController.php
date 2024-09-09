<?php

namespace Byg\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Byg\Admin\Http\Responses\Api\Response;
use Illuminate\Support\Facades\Gate;
/**
 *  @OA\Get (
 *      path="/admin/groups?draw={draw}&start={start}&length={length}",
 *      tags={"Group"},
 *      summary="管理員群組列表",
 *      description="管理員群組列表",
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
 *                                  "last_login_time":"2021-07-01 00:00:00"
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
 *      path="/admin/groups/{id}",
 *      tags={"Group"},
 *      summary="管理員群組詳細資料",
 *      description="管理員群組詳細資料",
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
 *              default=1
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
 *                      "permissions":"[]",
 *                      "created_at":"2021-07-01 00:00:00"
 *                  }
 *              }
 *          )
 *      )
 *  ),
 * 
 * @OA\Post (
 *      path="/admin/groups",
 *      tags={"Group"},
 *      summary="新增管理員群組",
 *      description="新增管理員群組",
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
 *              required={"name","permission"},
 *              @OA\Property(property="name", type="string", example="test", description="管理員名稱"),
 *              @OA\Property(property="permission", type="array", @OA\Items(type="string"), description="群組權限"),
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
 *      path="/admin/groups/{id}",
 *      tags={"Group"},
 *      summary="修改管理員群組",
 *      description="修改管理員群組",
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
 *          description="管理員群組ID",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name","permission"},
 *              @OA\Property(property="name", type="string", example="test", description="管理員名稱"),
 *              @OA\Property(property="permission", type="array", @OA\Items(type="string"), description="群組權限"),
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
 *      path="/admin/groups/{id}",
 *      tags={"Group"},
 *      summary="刪除管理員群組",
 *      description="刪除管理員群組",
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
 *          description="管理員群組ID",
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
class GroupController extends Controller
{
    protected $GroupService;

    public function __construct() {
        $this->GroupService = app(config('admin.groups.service'));
    }

    
    /**
     * 管理員群組列表
     *
     * @return void
     */
    public function index()
    {
        Gate::authorize('view', new \Byg\Admin\Models\Admin\Group());
        return Response::json(["data" => $this->GroupService->index(request()->all())]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('view', new \Byg\Admin\Models\Admin\Group());
        return Response::json([
            "data"  =>  collect(config('admin.groups.form.fields'))->values()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Byg\Admin\Http\Requests\Admin\Group\StoreRequest $request)
    {
        Gate::authorize('create', new \Byg\Admin\Models\Admin\Group());
        $this->GroupService->store($request->all());
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
        Gate::authorize('view', new \Byg\Admin\Models\Admin\Group());
        if(request()->ajax()) {
            return Response::json(["data"=>$this->GroupService->getGroup($id) ]);
        }
        $user = $this->GroupService->getUser($id);
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
    public function update(\Byg\Admin\Http\Requests\Admin\Group\UpdateRequest $request, string $id)
    {
        Gate::authorize('update', new \Byg\Admin\Models\Admin\Group());
        $this->GroupService->update($request->all(),$id);
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
        Gate::authorize('delete', new \Byg\Admin\Models\Admin\Group());
        $this->GroupService->delete($id);
        return Response::json(["message"=>__('admin::Admin.success.deleteSuccess')]);
    }
}
