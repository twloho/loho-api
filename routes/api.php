<?php

use Illuminate\Http\Request;

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

/**
 * @SWG\Swagger(
 *   schemes={"http"},
 *   host="api.loho.dev",
 *   basePath="/api",
 *   @SWG\Info(
 *     title="LOHO API",
 *     version="0.1.0",
 *   ),
 * )
 */

Route::get('v1/members', '\App\Association\Controllers\MemberController@index');
Route::post('v1/members', '\App\Association\Controllers\MemberController@store');
