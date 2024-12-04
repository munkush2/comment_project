<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CreateController;
use App\Http\Controllers\User\UpdateController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\EditController;
use App\Http\Controllers\User\DeleteController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\User\FeedbackController;
use App\Http\Controllers\User\ShowController;
use App\Models\Feedback;
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
    return view('welcome');
});



Route::get('/registration', function() {
    return view('register');
})->name('register');
Route::post('/register', [CreateController::class, '__invoke']);


Route::get('/login', function() {
    return view('login');
})->name('login');

Route::post('/authentication', [loginController::class, '__invoke']);







Route::prefix('/profile')->middleware(['auth'])->group(function () {
    Route::get('/edit', [EditController::class, '__invoke'])->name('edit');
    Route::post('/update', [UpdateController::class, '__invoke']);
    Route::delete('/delete', [DeleteController::class, '__invoke'])->name('delete');
    Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout');
                                 
});
Route::get('/feedback', [ShowController::class, '__invoke'])->name('feedback');
Route::get('/comments', [ShowController::class, 'getComments'])->name('feedbacks');

Route::prefix('/feedback')->middleware(['auth'])->group(function () {
    Route::post('/create', [FeedbackController::class, '__invoke'])->name('feedback.create');  
});


//Route::post('/update', [UpdateController::class, '__invoke']);
