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

// Route::middleware('auth')->group(function () {
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

    Route::get(
        '/add/discussions',
        [DiscussionController::class, 'add_discussion']
    )->name('add-discussion');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handle_login']);

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'handle_signup']);
