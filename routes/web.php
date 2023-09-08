<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'] )->name('dashboard'); /*function () {
    return view('welcome');
});*/

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.', 'middleware' => ['auth']], function () {

    Route::post('', [IdeaController::class, 'store'])->name('create')->withoutMiddleware(['auth']);
    
    Route::get('{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
    
    Route::put('{idea}', [IdeaController::class, 'update'])->name('update');
    
    Route::get('{idea}', [IdeaController::class, 'show'])->name('show')->withoutMiddleware(['auth']);
    
    Route::delete('{idea}', [IdeaController::class, 'destroy'])->name('delete');
    
    Route::group(['prefix' => '{idea}/comments/', 'as' => 'comments.'], function () {
    
        Route::post('', [CommentController::class, 'store'])->name('store');
        
        Route::get('{comment}/edit', [CommentController::class, 'edit'])->name('edit');
        
        Route::put('{comment}', [CommentController::class, 'update'])->name('update');
    });
});

// Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');
// Route::resource('ideas', IdeaController::class)->only(['show']);
// Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth'); // <- all do the same as the groups above

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store'])->name('store');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/terms', function(){ return view('terms'); })->name('terms');

Route::get('/feed', function () {
    // return view('feed');
});

// Route::get('/profile', [ProfileController::class, 'index']);
