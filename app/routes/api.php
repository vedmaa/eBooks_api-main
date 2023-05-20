<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\ModeratorController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResources([
        'users' => UserController::class,
        'users/{$id}' => UserController::class,

        'authors' => AuthorController::class,
        'authors/{$id}' => AuthorController::class,

        'books' => BookController::class,
        'books/{$id}' => BookController::class,

        'shelves' => ShelfController::class,
        'shelves/{$id}' => ShelfController::class,

        'bookshelves' => BookshelfController::class,
        'bookshelves/{$id}' => BookshelfController::class,

        'reviews' => ReviewController::class,
        'reviews/{$id}' => ReviewController::class,

        'moderators' => ModeratorController::class,
        'moderators/{$id}' => ModeratorController::class,

        'bookmarks' => BookmarkController::class,
        'bookmarks/{$id}' => BookmarkController::class,

        'roles' => RoleController::class,
        'roles/{$id}' => RoleController::class,
    ]);
});


Route::middleware('guest',)->group(function (){
    Route::post('login',[AuthController::class, 'login']);
    //Route::post('login1',[AuthController::class, 'login1']);
    Route::post('sendMessage',[AuthController::class, 'sendMessage']);
    Route::post('register',[AuthController::class, 'register']);
    Route::post('loginByToken',[AuthController::class, 'loginByToken']);
    Route::post('logout',[AuthController::class, 'logout']);
});

//Route::middleware('verified',)->group(function (){
//    Route::post('login1',[AuthController::class, 'login1']);
//    Route::post('sendMessage',[AuthController::class, 'sendMessage']);
//});

//Route::post('sendMessage',[AuthController::class, 'sendMessage'])->middleware('auth','verified');

Route::post('email/verification', [EmailVerificationController::class, 'resendNotification']);
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->name('verification.verify');

//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//
//    return redirect('/home');
//})->middleware(['auth', 'signed'])->name('verification.verify');
