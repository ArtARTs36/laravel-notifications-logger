<?php

use Illuminate\Support\Facades\Route;

Route::prefix('messages')->group(function () {
    Route::get('recipients', 'MessageController@recipients');
});

Route::apiResource('messages', 'MessageController');
Route::apiResource('systems', 'SystemController');
