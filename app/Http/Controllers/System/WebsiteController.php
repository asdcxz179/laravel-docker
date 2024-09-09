<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Byg\Admin\Http\Responses\Api\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 *  @OA\Get (
 *      path="/system/website?draw={draw}&start={start}&length={length}",
 *      tags={"Website"},
 *      summary="網站列表",
 *      description="網站列表",
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
 *                                  "name":"test",
 *                                  "prefix":"test",
 *                                  "front_domain":"test.com",
 *                                  "backend_domain":"admin.test.com",
 *                                  "status":1,
 *                                  "online_date":"",
 *                              }
 *                          }
 *                      }
 *                  }
 *             }
 *         ) 
 *      )
 *  )
 *  @OA\Get (
 *      path="/system/website/{id}",
 *      tags={"Website"},
 *      summary="站點詳細資料",
 *      description="站點詳細資料",
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
 *                      "name":"test",
 *                      "prefix":"test",
 *                      "front_domain":"test.com",
 *                      "backend_domain":"admin.test.com",
 *                      "status":1,
 *                      "online_date":"",
 *                  }
 *              }
 *          )
 *      )
 *  ),
 *  @OA\Post (
 *      path="/system/website",
 *      tags={"Website"},
 *      summary="新增站點",
 *      description="新增站點",
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
 *              required={"name","name","prefix","front_domain", "backend_domain", "status"},
 *              @OA\Property(property="name", type="string", example="test", description="網站名稱"),
 *              @OA\Property(property="prefix", type="string", example="test", description="Prefix"),
 *              @OA\Property(property="front_domain", type="string", example="http://google.com", description="前台網址"),
 *              @OA\Property(property="backend_domain", type="string", example="http://google.com", description="後台網址"),
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
 *      )
 *  )
 * 
 *  @OA\Put (
 *      path="/system/website/{id}",
 *      tags={"Website"},
 *      summary="修改站點",
 *      description="修改站點",
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
 *          description="網站ID",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name","name","prefix","front_domain", "backend_domain", "status"},
 *              @OA\Property(property="name", type="string", example="test", description="網站名稱"),
 *              @OA\Property(property="prefix", type="string", example="test", description="Prefix"),
 *              @OA\Property(property="front_domain", type="string", example="http://google.com", description="前台網址"),
 *              @OA\Property(property="backend_domain", type="string", example="http://google.com", description="後台網址"),
 *              @OA\Property(property="status", type="integer", example="1", description="狀態"),
 *              @OA\Property(property="online_date", type="string", example="2021-01-01", description="上線日期"),
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
 */
class WebsiteController extends Controller
{

    protected $websiteService;

    public function __construct()
    {
        $this->websiteService = app(config('website.service'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view', new \App\Models\System\Website());
        return Response::json(["data" => $this->websiteService->index([])]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('view', new \App\Models\System\Website());
        return Response::json([
            "data"  =>  collect(config('website.form.fields'))->values()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', new \App\Models\System\Website());
        $this->websiteService->store($request->all());
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
        Gate::authorize('view', new \App\Models\System\Website());
        return Response::json(["data"=>$this->websiteService->getWebsite($id) ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('update', new \App\Models\System\Website());
        $this->websiteService->update($request->all(),$id);
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
        Gate::authorize('delete', new \App\Models\System\Website());
    }
}
