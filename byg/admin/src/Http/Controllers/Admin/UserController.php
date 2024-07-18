<?php

namespace Byg\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Byg\Admin\Http\Responses\Api\Response;

class UserController extends Controller
{
    protected $UserService;

    public function __construct() {
        $this->UserService = app(config('admin.users.service'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response::json($this->UserService->index(request()->all()));
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
