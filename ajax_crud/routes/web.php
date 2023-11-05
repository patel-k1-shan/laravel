<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[StudentController::class,'index'])->name('student.index');
Route::get('student/all-student',[StudentController::class,'getStudentAjax'])->name('student.getstudentajax');
Route::get('student/create',[StudentController::class,'create'])->name('student.create');
Route::post('student/create',[StudentController::class,'store'])->name('student.store');
Route::get('student/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::post('student/update',[StudentController::class,'update'])->name('student.update');

Route::get('student/delete/{id}',[StudentController::class,'destroy'])->name('student.delete');
