<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([
//    'auth:sanctum'
])->group(function(){

    Route::post('submit',[\App\Http\Controllers\Api\SubmissionController::class, 'submit']);
});
