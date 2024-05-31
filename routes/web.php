<?php

use Illuminate\Support\Facades\Route;


// old
// Route::get('/', function () {
//     return view('welcome');
// });

// here’s the catch, if we do a hard refresh, Laravel will return a “404 Not Found” error. 
// This is happening because we don’t have web routes defined in Laravel.

// so what we have to do is given below: 


Route::get("api/test-me", function () {
    return response()->json(['message' => 'Hello from Laravel!']);
});

//keep it down when you want to test something without validation of client-side rendered

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');


// Route::get('/{vue_capture?}', function () {
//     return view('welcome');
// })->where('vue_capture', '[\/\w\.-]*');


// Route::get('/{vue_capture}', function () {
//     return view('welcome');
// })->where('vue_capture', '[\/\w\.-]*');


// Note: the question mark says that parameter is optional like , /home, /about yes /  also  means root allowed
//  and the other without questionmark says paramater is required. like /home, /about    but not /