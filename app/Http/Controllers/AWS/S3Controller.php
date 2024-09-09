<?php

namespace App\Http\Controllers\AWS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Byg\Admin\Http\Responses\Api\Response;
use App\Services\AWS\S3Service;
use App\Http\Requests\AWS\StoreRequest;
use App\Http\Requests\AWS\DeleteRequest;
use Illuminate\Support\Facades\Gate;

class S3Controller extends Controller
{
    public function __construct(
        public S3Service $s3Service
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view', new \App\Models\AWS\S3());
        return Response::json(["data" => [
            "folders"   =>  [
                'label' => '/',
                'value' => '/',
                'children' => $this->s3Service->getFolders()
            ],
        ]]);
    }

    /**
     * Show the form for creating a new resource.men
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Gate::authorize('create', new \App\Models\AWS\S3());
        $path = $request->path;
        $file = $request->file('file');
        $this->s3Service->insertFile($path, $file);
        return Response::json(["data" => [
            "files" => $this->s3Service->getFiles($path)
        ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('view', new \App\Models\AWS\S3());
        return Response::json(["data" => [
            "files" => $this->s3Service->getFiles(request('path'))
        ]]);
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
    public function destroy(DeleteRequest $request, string $id)
    {
        Gate::authorize('delete', new \App\Models\AWS\S3());
        $this->s3Service->deleteFile(request('file'));
        return Response::json([]);
    }
}
