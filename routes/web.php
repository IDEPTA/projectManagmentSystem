<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/image', function () {
    return view('UserAvatarImg', ["data" => User::find(1)]);
});
