<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

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

Route::get('/', function () {
    if (auth()->check()) {
        if (Gate::allows('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Gate::allows('student')) {
            return redirect()->route('student.dashboard');
        }
    }

   

    return redirect()->route('login');
});


 // solo para hacer cuenta admin provisional
Route::get('/register', function () {


    return view ('welcome');
});

// solo para hacer cuenta admin provisional termina

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if (Gate::allows('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Gate::allows('student')) {
            return redirect()->route('student.dashboard');
        }
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard')->middleware('can:admin');
    Route::get('/dashboard/student', 'App\Http\Controllers\StudentController@index')->name('student.dashboard')->middleware('can:student');
    Route::get('/add-student', 'App\Http\Controllers\StudentController@viewAddStudent')->name('add-student')->middleware('can:admin');
    Route::post('/register-student', 'App\Http\Controllers\StudentController@addStudent')->name('register-student')->middleware('can:admin');
    Route::get('/create-form', 'App\Http\Controllers\AdminController@showCreateForm')->name('create-form');
    Route::post('/admin.save-form', 'App\Http\Controllers\AdminController@createForm')->name('admin.save-form')->middleware('can:admin');
    Route::get('/add-techer-student', 'App\Http\Controllers\AdminController@showAddTeachersForm')->name('add-techer-student')->middleware('can:admin');
    Route::post('/user.add-teachers', 'App\Http\Controllers\AdminController@addTeachersToStudents')->name('user.add-teachers');
    Route::get('/forms/{formId}/student', 'App\Http\Controllers\StudentController@showStudentForm')->name('forms.student-form');
    Route::post('/forms.submit/{form}', 'App\Http\Controllers\FormController@saveSubmitForm')->name('forms.submit');
    Route::get('/students', 'App\Http\Controllers\StudentController@showStudents')->name('students.list')->middleware('can:admin');
    Route::get('/forms', 'App\Http\Controllers\FormController@showForms')->name('forms.list')->middleware('can:admin');
    Route::get('/forms/{formId}/edit', 'App\Http\Controllers\FormController@editForm')->name('forms.edit')->middleware('can:admin');
    Route::put('/forms/{formId}', 'App\Http\Controllers\FormController@updateForm')->name('forms.update');
    Route::get('/forms/{formId}/statistics', 'App\Http\Controllers\FormController@showStatistics')->name('forms.statistics');


});


