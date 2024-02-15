<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Package;
use App\Models\Group;

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

Route::get('/contact_us', function () {
    return view('contact_us');
})->name('contact_us');

Route::get('/dashboard', [PackageController::class, 'search'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get(
    '/group/{group:name}',
    [PackageController::class, 'group']
)->name('group.show');

Route::get('/search', [PackageController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/buy', [PackageController::class, 'profile_buy'])->name('profile.buy');
    Route::get('/profile/own', [PackageController::class, 'profile_own'])->name('profile.own');
    Route::post('/packages/{package:slug}', [PackageController::class, 'buy'])->name('packages.buy');
    Route::post('/packages/file/{package:slug}', [PackageController::class, 'file'])->name('packages.file');
    Route::get('/packages/file/{package:slug}', [PackageController::class, 'upload'])->name('packages.upload');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/packages', PackageController::class);
require __DIR__ . '/auth.php';
