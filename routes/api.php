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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users

Route::post('/user/signup', [
    'uses' => 'UserController@signup'
]);

Route::post('/user/signin', [
    'uses' => 'UserController@signin'
]);

Route::get('/user/isLoggedIn', [
    'uses' => 'UserController@isLoggedIn',
    'middleware' => ['auth.jwt']
]);

// Workflow Management
Route::middleware(['auth.jwt'])->group(function () {
    Route::post('/workflowmanagement/createworkflowheader', [
        'uses' => 'WorkflowManagementController@createWorkflowHeader'
    ]);
});