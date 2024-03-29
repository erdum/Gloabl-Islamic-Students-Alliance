<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth')->group(function () {
    Route::get(
        '/',
        [DiscussionController::class, 'get_all_discussions']
    )->name('home');

    Route::get(
        '/discussions/{id}',
        [DiscussionController::class, 'get_discussion']
    )->name('discussion');

    Route::get(
        '/discussions/{discussion_id}/up-vote',
        [DiscussionController::class, 'up_vote']
    )->name('up-vote');

    Route::delete(
        '/discussions/{discussion_id}/up-vote',
        [DiscussionController::class, 'delete_up_vote']
    );

    Route::get(
        '/discussions/{discussion_id}/down-vote',
        [DiscussionController::class, 'down_vote']
    )->name('down-vote');

    Route::delete(
        '/discussions/{discussion_id}/down-vote',
        [DiscussionController::class, 'delete_down_vote']
    );

    Route::post(
        '/add/discussions',
        [DiscussionController::class, 'add_discussion']
    )->name('add-discussion');

    Route::post(
        '/discussions/{discussion_id}/closed',
        [DiscussionController::class, 'calculate_seconds_spent']
    )->name('page-close-time');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handle_login'])
    ->name('handle-login');

Route::get('/forget-password', [AuthController::class, 'forget_password'])
    ->name('forget-password');
Route::post(
    '/forget-password',
    [AuthController::class, 'handle_forgotten_password']
)->name('handle-forgotten-passowrd');

Route::get('/reset-password', [AuthController::class, 'reset_password'])
    ->name('reset-password');
Route::post(
    '/reset-password',
    [AuthController::class, 'handle_reset_password']
)->name('handle-reset-password');

Route::get('/verify-otp', [AuthController::class, 'verify_otp'])
    ->name('verify-otp');
Route::post('/verify-otp', [AuthController::class, 'handle_otp'])
    ->name('handle-otp');

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'handle_signup'])
    ->name('handle-signup');
