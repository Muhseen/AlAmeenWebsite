<?php

use GuzzleHttp\Psr7\Request;
use App\Models\StatesAndLgas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProgrammesController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\StudentPaymentsController;
use App\Http\Controllers\AccountCodeController;
use App\Http\Controllers\apiCalls;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SetFeesController;
use App\Http\Controllers\studentScholarshipController;

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

Auth::routes();
Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/getLgas', function (Request $request) {
        $lgas = StatesAndLgas::where('state', $request->stateId)->get();
        return json_encode(['lgas' => $lgas]);
    });
    Route::get('/dashboard', function () {
        return redirect('home');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //AccountCodes
    Route::resource('/accountCodes', AccountCodeController::class);
   
   //Applicants Controller
   Route::resource('Applicants', ApplicantController::class);
   
    //programmes Controller;

    Route::get('/getCourses', [ProgrammesController::class, 'getCourses']);
    Route::get('/getLevels', [ProgrammesController::class, 'getLevels']);

    //reports Controller
    Route::get('/reports', [reportController::class, 'index']);
    Route::get('/reports/owing', [reportController::class, 'getOwingStudents']);
    Route::get('/studentLedger', [reportController::class, 'studentLedger']);
    Route::get('/reports/OwingParticularFee', [reportController::class, 'owingParticularFee']);
    Route::get('/reports/receiptsByName', [reportController::class, 'receiptsByName']);
    Route::get('/reports/receiptsByDateRange', [reportController::class, 'receiptsByDateRange']);
    Route::get('/reports/receiptsByClass', [reportController::class, 'receiptsByClass']);
    Route::get('/reports/receiptsByAccountCode', [reportController::class, 'receiptsByAccountCode']);
    Route::get('/reports/receiptsPaidIntoAccount', [reportController::class, 'receiptsPaidIntoAccount']);
    //Set Fees Controller
    Route::get('/setFees', [SetFeesController::class, 'index']);
    Route::get('/setParticularClass', [SetFeesController::class, 'particularClass']);
    Route::get('/setParticularStudent', [SetFeesController::class, 'particularStudent']);
    Route::get('/setFeesForAll', [SetFeesController::class, 'allStudents']);

    //Student Controller
    Route::resource('/Students', StudentController::class);
    Route::get('/getStudent', [StudentController::class, 'getStudent']);

    //studentPaymentController
    Route::resource('/studentPayments', StudentPaymentsController::class);

    Route::resource('/studentScholarship', studentScholarshipController::class);
    //faculty, course and level calls
    Route::get('/getCourses', [apiCalls::class, 'getCourses']);
    Route::get('/getLevels', [apiCalls::class, 'getLevels']);
});