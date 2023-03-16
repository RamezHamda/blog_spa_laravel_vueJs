<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DashboardPostController;
use App\Http\Controllers\API\RelatedPostsController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisteredUserController::class, 'store']);

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum');


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories/create', [CategoryController::class, 'store']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
    // Posts routes
    
    Route::post('posts/create', [PostController::class, 'store']);
    // For edit post (Showing data in form fields when editing a post and updating it)
    Route::get('posts/{post:slug}', [PostController::class, 'show']);
    Route::put('posts/{post:slug}', [PostController::class, 'update']);
    // For edit post (Showing data in form fields when editing a post and updating it)
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    // Home routes 
    
    // Related posts routes
    
});
Route::get('posts', [PostController::class, 'index']);
Route::get('home-posts', [HomeController::class, 'index']);
Route::get('related-posts/{post:slug}', [RelatedPostsController::class, 'index']);
// Route::post('register', [RegisteredUserController::class, 'store']);

// Route::post('register', [AuthController::class, 'register']);

// Route::post('login', [AuthController::class, 'login']);

// Route::post('logout', [AuthController::class, 'logout']);

