<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

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


Route::get('/', [LinkController::class, 'index'])->name('link.add');
Route::get('/all-links', [LinkController::class, 'allLinks'])->name('all.links');
Route::get('/one/{id?}', [LinkController::class, 'oneLink'])->name('link');
Route::get('/one/statistic/{id?}', [LinkController::class, 'linkStatistic'])->name('link.statistic');
Route::get('/l/{custom_code?}', [LinkController::class, 'customLink'])->name('custom.link');
Route::post('/add', [LinkController::class, 'add'])->name('save.link');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
