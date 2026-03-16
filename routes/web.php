<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/talent/{name}', function ($name) {
    return view('talent-details', ['name' => str_replace('-', ' ', $name)]);
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/talent-network', function () {
    return view('talent');
});

Route::get('/become-a-model', function () {
    return view('become-a-model');
});
