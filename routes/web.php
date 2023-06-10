<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Home');
});
Route::get('/rank', function () {
    return view('Rank');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('Admin');
    });
    Route::get('/crudadmin', function () {
        return view('cruds.AdminCrud');
    });
    Route::get('/crudstudent', function () {
        return view('cruds.StudentCrud');
    });
    Route::get('/crudteacher', function () {
        return view('cruds.TeacherCrud');
    });
});
