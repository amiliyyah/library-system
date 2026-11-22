<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberPortalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('can:manage-master')->group(function () {
        Route::resource('books', BookController::class)->except(['index', 'show']);
    });

    Route::resource('books', BookController::class)->only(['index', 'show']);
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::middleware('can:staff')->group(function () {
        Route::resource('members', MemberController::class)->except(['show']);

        Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
        Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
        Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
        Route::get('/borrowings/{borrowing}', [BorrowingController::class, 'show'])->name('borrowings.show');
        Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    });

    Route::middleware('can:member')->prefix('saya')->name('portal.')->group(function () {
        Route::get('/peminjaman', [MemberPortalController::class, 'index'])->name('borrowings.index');
        Route::get('/peminjaman/create', [MemberPortalController::class, 'create'])->name('borrowings.create');
        Route::post('/peminjaman', [MemberPortalController::class, 'store'])->name('borrowings.store');
        Route::patch('/peminjaman/{borrowing}/return', [MemberPortalController::class, 'returnBook'])->name('borrowings.return');
    });
});

Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::resource('users', UserController::class)->only(['index']);
});