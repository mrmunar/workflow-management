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

Route::middleware(['auth.jwt'])->group(function () {

    Route::get('/user/isLoggedIn', [
        'uses' => 'UserController@isLoggedIn',
        'middleware' => ['auth.jwt']
    ]);

    Route::get('/user/getUsersForDropdown', [
        'uses' => 'UserController@getUsersForDropdown',
        'middleware' => ['auth.jwt']
    ]);

});


// Workflow Management
Route::middleware(['auth.jwt'])->group(function () {

    Route::post('/workflowmanagement/createUpdateWorkflowHeader', [
        'uses' => 'WorkflowManagementController@createUpdateWorkflowHeader'
    ]);

    Route::get('/workflowmanagement/getWorkflowProcessForDropdown', [
        'uses' => 'WorkflowManagementController@getWorkflowProcessForDropdown'
    ]);
    
    Route::post('/workflowmanagement/createUpdateWorkflowProcess', [
        'uses' => 'WorkflowManagementController@createUpdateWorkflowProcess'
    ]);

    Route::post('/workflowmanagement/createUpdateWorkflowProcessActivities', [
        'uses' => 'WorkflowManagementController@createUpdateWorkflowProcessActivities'
    ]);
    
    Route::get('/workflowmanagement/getParamsActivitiesForDropdown', [
        'uses' => 'WorkflowManagementController@getParamsActivitiesForDropdown'
    ]);
    
    Route::get('/workflowmanagement/checkIfProcessAndActivityExists', [
        'uses' => 'WorkflowManagementController@checkIfProcessAndActivityExists'
    ]);
});

Route::get('/workflowmanagement/getWorkflows', [
    'uses' => 'WorkflowManagementController@getWorkflows'
]);
