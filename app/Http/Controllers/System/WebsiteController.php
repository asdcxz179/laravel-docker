<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Byg\Admin\Http\Responses\Api\Response;
use Illuminate\Http\Request;

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
        return Response::json(["data" => $this->websiteService->index([])]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Response::json([
            "data"  =>  collect(config('website.form.fields'))->values()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        //
    }
}
