<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EmployeeController::class, 'show_employee']);
Route::get('add_employee', [EmployeeController::class, 'add_employee']);
Route::get('update_employee/{id}', [EmployeeController::class, 'update_employee']);
