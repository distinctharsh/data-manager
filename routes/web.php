<?php

use Illuminate\Support\Facades\Route;


// old
// Route::get('/', function () {
//     return view('welcome');
// });

// here’s the catch, if we do a hard refresh, Laravel will return a “404 Not Found” error. 
// This is happening because we don’t have web routes defined in Laravel.

// so what we have to do is given below: 


Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
