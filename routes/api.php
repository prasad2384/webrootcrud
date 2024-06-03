<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('add_employee',[EmployeeController::class,'add_employee_api']); // insert
Route::get('fetch_employee', [EmployeeController::class, 'fetch_employee_api']); //fetch
Route::delete('delete_employee/{id}', [EmployeeController::class, 'delete_employee_api']);//delete
Route::put('update_employee/{id}',[EmployeeController::class,'update_employee_api']); //update
