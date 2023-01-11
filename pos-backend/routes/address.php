<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Address\DivisionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix'=>'/address', 'namespace' => 'Address'], function() {

    // Division Routes....
    Route::group(['prefix'=>'/division'], function() {;
       Route::get('/list', [DivisionController::class, 'list']);
       Route::get('/get-all', [DivisionController::class, 'getAll']);
       Route::post('/store', [DivisionController::class, 'store']);
       Route::put('/update/{id}', [DivisionController::class, 'update']);
       Route::get('/show/{id}', [DivisionController::class, 'show']);
       Route::delete('/toggle-status/{id}', [DivisionController::class, 'toggleStatus']);
       Route::delete('/destroy/{id}', [DivisionController::class, 'destroy']);
   });
});
