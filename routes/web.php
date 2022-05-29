<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Daybook;


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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Daybook::class,'index1'])->name('dashboard');

    Route::post('/add-day-book', [Daybook::class,'index']);
    
});

require __DIR__.'/auth.php';

