<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;


Auth::routes();


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('admin.home');
});


//company routes

Route::get('/manage-companies',[CompanyController::class,'index'])->middleware('auth');
Route::get('/add-company',[CompanyController::class,'create'])->middleware('auth');
Route::post('/ store-company',[CompanyController::class,'store'])->middleware('auth');
Route::get('edit-company/{id}',[CompanyController::class,'edit'])->middleware('auth');
Route::get('/remove-companies',[CompanyController::class,'destroy'])->middleware('auth');
Route::post('update-company/{id}',[CompanyController::class,'update'])->middleware('auth');

//employee routes
Route::get('/manage-employee',[EmployeeController::class,'index'])->middleware('auth');
Route::get('/add-employee',[EmployeeController::class,'create'])->middleware('auth');
Route::post('/store-employee',[EmployeeController::class,'store'])->middleware('auth');
Route::get('edit-employee/{id}',[EmployeeController::class,'edit'])->middleware('auth');
Route::get('/remove-employee/{id}',[EmployeeController::class,'destroy'])->middleware('auth');
Route::post('update-employee/{id}',[EmployeeController::class,'update'])->middleware('auth');