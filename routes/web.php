<?php

use Illuminate\Support\Facades\Route;

Route::get("api/test-me", function () {
    return response()->json(['message' => 'Hello from Laravel!']);
});

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
