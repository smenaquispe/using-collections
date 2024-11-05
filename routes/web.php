<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Types\Relations\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'users'], function () {
    Route::post('/', [UserController::class, 'insert']);
    Route::post('append-attribute', [UserController::class, 'appendAttribute']);
    Route::post('contains-email', [UserController::class, 'containsEmail']);
    Route::get('diff-with-admins', [UserController::class, 'diffWithAdmins']);
    Route::post('expect-id', [UserController::class, 'expectId']);
    Route::post('find-by-id', [UserController::class, 'findById']);
    Route::post('find-or-fail-by-id', [UserController::class, 'findOrFailById']);
    Route::get('intersect-with-admins', [UserController::class, 'intersectWithAdmins']);
    Route::get('load-posts', [UserController::class, 'loadPosts']);
    Route::get('load-missing-posts', [UserController::class, 'loadMissingPosts']);
    Route::get('model-keys', [UserController::class, 'getModelKeys']);
    Route::get('make-visible-email', [UserController::class, 'makeVisibleEmail']);
    Route::get('make-hidden-email', [UserController::class, 'makeHiddenEmail']);
    Route::get('only-ids', [UserController::class, 'onlyIds']);
    Route::get('set-visible-attributes', [UserController::class, 'setVisibleAttributes']);
    Route::get('set-hidden-attributes', [UserController::class, 'setHiddenAttributes']);
    Route::get('to-query-active-users', [UserController::class, 'toQueryActiveUsers']);
    Route::get('unique-emails', [UserController::class, 'uniqueEmails']);
});
