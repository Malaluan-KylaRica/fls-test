<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get all emp
Route::get('faculties', [FacultyController::class, 'getFaculty']);

//get specific employee
Route::get('faculty/{id}', [FacultyController::class, 'getFacultyByID']);

//add 
Route::post('addFaculty', [FacultyController::class, 'addFaculty']);
Route::post('addFaculty', [FacultyController::class, 'deleteFaculty']);