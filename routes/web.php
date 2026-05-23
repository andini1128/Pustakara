<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =============================================
// LANDING
// =============================================
Route::get('/', [BookController::class, 'landing'])->name('landing');

Route::get('/landing', [BookController::class, 'landing'])->name('landing.page');

// =============================================
// ROUTE LOGIN
// =============================================
Route::get('/loginadmin', function () {
    return view('auth.loginadmin');
})->name('login');

Route::post('/loginadmin', [AuthController::class, 'login'])->name('login.post');

Route::get('/loginpetugas', function () {
    return view('auth.loginadmin');
})->name('login.petugas');

Route::post('/loginpetugas', [AuthController::class, 'loginPetugas'])->name('login.petugas.post');

Route::get('/loginuser', function () {
    return view('auth.loginuser');
})->name('login.user');

Route::post('/loginuser', [AuthController::class, 'loginUser'])->name('login.user.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =============================================
// REGISTER
// =============================================
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// =============================================
// ROUTE YANG BUTUH LOGIN
// =============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/dashboard-admin', [BookController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::get('/dashboardadmin', [BookController::class, 'adminDashboard'])->name('dashboard.admin.legacy');
    Route::get('/dashboard-petugas', [BookController::class, 'staffDashboard'])->name('dashboard.petugas');
    Route::get('/dashboardpetugas', [BookController::class, 'staffDashboard'])->name('dashboard.petugas.legacy');
    Route::get('/petugas/buku', [BookController::class, 'staffBooks'])->name('staff.books');
    Route::get('/petugas/peminjaman', [BookController::class, 'staffLoans'])->name('staff.loans');
    Route::patch('/petugas/peminjaman/{loan}/setujui', [BookController::class, 'approveLoan'])->name('staff.loans.approve');
    Route::patch('/petugas/peminjaman/{loan}/tolak', [BookController::class, 'rejectLoan'])->name('staff.loans.reject');
    Route::delete('/petugas/peminjaman/{loan}', [BookController::class, 'destroyLoan'])->name('staff.loans.destroy');
    Route::get('/petugas/laporan', [BookController::class, 'staffReports'])->name('staff.reports');
    Route::get('/petugas/laporan/{type}', [BookController::class, 'staffReportShow'])->name('staff.reports.show');
    Route::get('/petugas/laporan/{type}/cetak', [BookController::class, 'adminReportPrint'])->name('staff.reports.print');
    Route::get('/admin/peminjaman', [BookController::class, 'adminLoans'])->name('admin.loans');
    Route::patch('/admin/peminjaman/{loan}/setujui', [BookController::class, 'approveLoan'])->name('admin.loans.approve');
    Route::patch('/admin/peminjaman/{loan}/tolak', [BookController::class, 'rejectLoan'])->name('admin.loans.reject');
    Route::delete('/admin/peminjaman/{loan}', [BookController::class, 'destroyLoan'])->name('admin.loans.destroy');
    Route::get('/admin/pengguna', [BookController::class, 'adminUsers'])->name('admin.users');
    Route::delete('/admin/pengguna/{user}', [BookController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/petugas', [BookController::class, 'adminStaff'])->name('admin.staff');
    Route::get('/admin/petugas/create', [BookController::class, 'createStaff'])->name('admin.staff.create');
    Route::post('/admin/petugas', [BookController::class, 'storeStaff'])->name('admin.staff.store');
    Route::get('/admin/petugas/{user}/edit', [BookController::class, 'editStaff'])->name('admin.staff.edit');
    Route::put('/admin/petugas/{user}', [BookController::class, 'updateStaff'])->name('admin.staff.update');
    Route::delete('/admin/petugas/{user}', [BookController::class, 'destroyStaff'])->name('admin.staff.destroy');
    Route::get('/admin/profil-petugas', [BookController::class, 'staffProfiles'])->name('admin.staff.profiles');
    Route::get('/admin/profil-admin', [BookController::class, 'adminProfiles'])->name('admin.profiles');
    Route::get('/admin/profil-admin/{user}/edit', [BookController::class, 'editAdminProfile'])->name('admin.profiles.edit');
    Route::put('/admin/profil-admin/{user}', [BookController::class, 'updateAdminProfile'])->name('admin.profiles.update');
    Route::get('/admin/laporan', [BookController::class, 'adminReports'])->name('admin.reports');
    Route::get('/admin/laporan/{type}', [BookController::class, 'adminReportShow'])->name('admin.reports.show');
    Route::get('/admin/laporan/{type}/cetak', [BookController::class, 'adminReportPrint'])->name('admin.reports.print');
    Route::get('/admin/ulasan', [BookController::class, 'adminReviews'])->name('admin.reviews');
    Route::delete('/admin/ulasan/{review}', [BookController::class, 'destroyReview'])->name('admin.reviews.destroy');
    Route::get('/kategori', [BookController::class, 'categories'])->name('books.categories');
    Route::get('/kategori/create', [BookController::class, 'createCategory'])->name('books.categories.create');
    Route::post('/kategori', [BookController::class, 'storeCategory'])->name('books.categories.store');
    Route::resource('books', BookController::class)->except(['show']);
    Route::get('/profile-user', [BookController::class, 'userProfile'])->name('profile.user');
    Route::get('/profile-user/edit', [BookController::class, 'editUserProfile'])->name('profile.user.edit');
    Route::put('/profile-user', [BookController::class, 'updateUserProfile'])->name('profile.user.update');
    Route::get('/favorit', [BookController::class, 'userFavorites'])->name('favorites.index');
    Route::post('/favorit/{book}', [BookController::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::get('/pinjam/{book}', [BookController::class, 'createLoan'])->name('loans.create');
    Route::post('/pinjam/{book}', [BookController::class, 'borrowBook'])->name('loans.borrow');
    Route::get('/peminjaman/{loan}/bukti', [BookController::class, 'loanReceipt'])->name('loans.receipt');
    Route::get('/riwayat-peminjaman', [BookController::class, 'userLoanHistory'])->name('loans.history');
    Route::patch('/riwayat-peminjaman/{loan}/kembalikan', [BookController::class, 'returnLoan'])->name('loans.return');
    Route::post('/riwayat-peminjaman/{loan}/ulasan', [BookController::class, 'storeReview'])->name('loans.review.store');
    Route::get('/dashboard-user', [BookController::class, 'userDashboard'])->name('dashboard.user');
});

Route::get('/koleksi-buku', [BookController::class, 'userCollection'])->name('koleksi.buku');
