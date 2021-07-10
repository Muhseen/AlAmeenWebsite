<?php

use GuzzleHttp\Psr7\Request;
use App\Models\StatesAndLgas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProgrammesController;

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
    return redirect('login');
});

Auth::routes();
Route::get('/getLgas', function (Request $request) {
    $lgas = StatesAndLgas::where('state', $request->stateId)->get();
    return json_encode(['lgas' => $lgas]);
});
Route::get('/dashboard', function () {
    return redirect('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/Students', StudentController::class);

//reports Controller
Route::view('/reports', 'reports.index');
Route::get('/reports/owing', [App\Http\Controllers\reportController::class, 'getOwingStudents']);

//programmes Controller;

Route::get('/getCourses', [ProgrammesController::class, 'getCourses']);
Route::get('/getLevels', [ProgrammesController::class, 'getLevels']);