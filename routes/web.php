<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventPhotoController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/eventos/{slug}', [HomeController::class, 'show'])->name('event.single');

Route::prefix('/enrollment')->name('enrollment.')->group(function(){
    Route::get('/start/{event:slug}', [EnrollmentController::class, 'start'])->name('start');
    Route::get('/confirm', [EnrollmentController::class, 'confirm'])->name('confirm')->middleware('auth');
    Route::get('/process', [EnrollmentController::class, 'process'])->name('process')->middleware('auth');
});

Route::middleware(['auth', 'verified'])->prefix('/admin')->name('admin.')->group(function() {
    // Route::prefix('/events')->name('events.')->group(function(){
    //     // Route::get('/', [EventController::class,'index'])->name('index');
    //     // Route::get('/create', [EventController::class,'create'])->name('create');
    //     // Route::post('/store', [EventController::class,'store'])->name('store');
    //     // Route::get('/{event}/edit', [EventController::class,'edit'])->name('edit');
    //     // Route::put('/update/{event}', [EventController::class,'update'])->name('update');
    //     // Route::get('/destroy/{event}', [EventController::class,'destroy'])->name('destroy');
       
    // });

    Route::resource('/events', EventController::class);
    Route::resource('events.photos', EventPhotoController::class)->only(['index','store','destroy']);

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route::resources([
    //     '/events' => EventController::class,
    //     'events.photos' => EventPhotoController::class
    // ]);
    
});

// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');





Auth::routes();
