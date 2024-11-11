<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'insert']);
    Route::post('after-id', [UserController::class, 'afterById']);
    Route::get('average-age', [UserController::class, 'averageAge']);
    Route::post('before-id', [UserController::class, 'beforeById']);
    Route::post('chunk-users', [UserController::class, 'chunkUsers']);
    Route::post('chunk-while-user-age-is-less-than', [UserController::class, 'chunkWhileUserAgeIsLessThan']);
    Route::post('contains-email', [UserController::class, 'containsEmail']);
    Route::get('contains-only-one-item', [UserController::class, 'containsOneItem']);
    Route::get('count-users', [UserController::class, 'countUsers']);
    Route::get('count-by-role', [UserController::class, 'countByRole']);
    Route::get('cross-join-with-posts', [UserController::class, 'crossJoinWithPosts']);
    Route::get('make-dd', [UserController::class, 'makeDD']);
    Route::get('diff-with-admins', [UserController::class, 'diffWithAdmins']);
    Route::get('diff-assoc-with-admins', [UserController::class, 'diffAssocWithAdmins']);
    Route::get('diff-keys-with-admins', [UserController::class, 'diffKeysWithAdmins']);
    Route::post('doesnt-contain-email', [UserController::class, 'doesntContainEmail']);
    Route::get('dot', [UserController::class, 'dot']);

     // Nuevas rutas para cada método de Collection solicitado
     Route::get('dump-users', [UserController::class, 'dumpUsers']);
     Route::get('duplicates', [UserController::class, 'duplicatesByLastName']);
     Route::get('duplicates-strict', [UserController::class, 'duplicatesStrictByLastName']);
     Route::get('each', [UserController::class, 'eachEmail']);
     Route::get('ensure', [UserController::class, 'ensureExample']);
     Route::get('every', [UserController::class, 'everyExample']);
     Route::get('filter', [UserController::class, 'filterExample']);
     Route::get('first', [UserController::class, 'firstExample']);
     Route::get('first-or-fail', [UserController::class, 'firstOrFailExample']);
     Route::post('first-where', [UserController::class, 'firstWhereLastName']);
     Route::get('flat-map', [UserController::class, 'flatMapExample']);
     Route::get('flatten', [UserController::class, 'flattenExample']);
     Route::get('flip', [UserController::class, 'flipExample']);
     Route::post('forget', [UserController::class, 'forgetExample']);
     Route::post('for-page', [UserController::class, 'forPageExample']);
     Route::post('get', [UserController::class, 'getExample']);
     Route::post('group-by', [UserController::class, 'groupByExample']);
     Route::post('has', [UserController::class, 'hasExample']);
     Route::post('implode', [UserController::class, 'implodeExample']);
     Route::post('intersect', [UserController::class, 'intersectExample']);
     Route::get('intersect-assoc', [UserController::class, 'intersectAssocExample']);
     Route::get('intersect-by-keys', [UserController::class, 'intersectByKeysExample']);
     Route::get('is-empty', [UserController::class, 'isEmptyExample']);

     Route::get('is-not-empty', [UserController::class, 'isNotEmpty']);
     Route::get('key-by', [UserController::class, 'keyBy']);
     Route::get('keys', [UserController::class, 'keys']);
     Route::get('lazy', [UserController::class, 'lazy']);
     Route::get('macro', [UserController::class, 'macro']);
     Route::get('make', [UserController::class, 'make']);
     Route::get('map', [UserController::class, 'map']);
     Route::get('map-into', [UserController::class, 'mapInto']);
     Route::get('map-to-groups', [UserController::class, 'mapToGroups']);
     Route::get('map-with-keys', [UserController::class, 'mapWithKeys']);
     Route::get('max', [UserController::class, 'max']);
     Route::get('median', [UserController::class, 'median']);     
     Route::post('join', [UserController::class, 'join']);
     Route::post('last', [UserController::class, 'last']);
     Route::get('map-spread', [UserController::class, 'mapSpread']);


     Route::get('min', [UserController::class, 'min']);
     Route::get('mode', [UserController::class, 'mode']);
     Route::get('pluck', [UserController::class, 'pluck']);
     Route::get('pop', [UserController::class, 'pop']);
 
     Route::post('merge', [UserController::class, 'merge']);
     Route::post('merge-recursive', [UserController::class, 'mergeRecursive']);
     Route::post('multiply', [UserController::class, 'multiply']);
     Route::post('nth', [UserController::class, 'nth']);
     Route::post('only', [UserController::class, 'only']);
     Route::post('pad', [UserController::class, 'pad']);
     Route::post('partition', [UserController::class, 'partition']);
     Route::post('percentage', [UserController::class, 'percentage']);
     Route::post('pipe', [UserController::class, 'pipe']);
     Route::post('pipe-into', [UserController::class, 'pipeInto']);
     Route::post('pipe-through', [UserController::class, 'pipeThrough']);


    Route::get('append-attribute', [UserController::class, 'appendAttribute']);
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


Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/', [PostController::class, 'insert']);
});