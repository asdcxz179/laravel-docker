<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = \App\Models\User::where(['id'=>2])->first();
    $token = $user->createToken('token-name')->plainTextToken;
    dump($token);
    return view('welcome');
});
