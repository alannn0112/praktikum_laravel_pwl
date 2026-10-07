<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
   // return redirect ('https://www.youtube.com/');
});

Route::get('/hello', function () {
    return view('hello');
   // return redirect ('https://www.youtube.com/');
});
