<?php

namespace Byg\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="BYG 總後台 API",
 *      description="BYG 總後台 API 集成",
 *      @OA\Contact(
 *          email="asdcxz179@gmail.com"
 *      ),
 * )
 * @OA\PathItem(
 *      path="/"
 *  )
 * @OA\server(
 *      url = "http://localhost:8081/api",
 *      description="測試區"
 * )
 * @OA\Components(
 *     @OA\Response(
 *          response="200",
 *          description="成功",
 *          @OA\JsonContent(
 *              example={
 *                  "status":200,
 *                  "message":"OK",
 *              }
 *          ),
 *     ),
 *     @OA\Response(
 *         response="400",
 *         description="客戶端錯誤",
 *         @OA\JsonContent(
 *               example={
 *                   "status":400,
 *                   "message":"客戶端錯誤",
 *               }
 *           ),
 *     ),
 *     @OA\Response(
 *          response="401",
 *          description="身份驗證失敗",
 *          @OA\JsonContent(
 *              example={
 *                  "status":401,
 *                  "message":"Unauthorized",
 *              }
 *          ),
 *     ),
 *     @OA\Response(
 *          response="404",
 *          description="找不到請求的資源",
 *          @OA\JsonContent(
 *              example={
 *                  "status":404,
 *                  "message":"Not Found",
 *              }
 *          ),
 *     ),
 *     @OA\Response(
 *          response="405",
 *          description="不支援此方法",
 *          @OA\JsonContent(
 *              example={
 *                  "status":405,
 *                  "message":"Method Not Allowed",
 *              }
 *          ),
 *     ),
 *     @OA\Response(
 *          response="500",
 *          description="伺服器發生錯誤",
 *          @OA\JsonContent(
 *              example={
 *                  "status":500,
 *                  "message":"伺服器發生錯誤",
 *              }
 *          ),
 *     ),
 *
 * )
 */

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
