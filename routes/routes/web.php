<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| Google Authentication Routes
|--------------------------------------------------------------------------
*/


// Intercept any attempt to go to /login and bounce them to the homepage
Route::redirect('/login', '/'); #REDIRECT


Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('auth.google');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Car Routes
|--------------------------------------------------------------------------
*/

Route::get('/cars', [CarController::class, 'index']);

Route::post('/processcar', [CarController::class, 'store'])
    ->middleware('throttle:10,1');

Route::get('/carregister', function () {
    return view('carregister');
});

/*
|--------------------------------------------------------------------------
| Other Pages
|--------------------------------------------------------------------------
*/

Route::get('/live', function () {
    return view('live');
});

Route::get('/crowdworkers', function () {
    return view('crowdworkers');
})->middleware('auth');

Route::get('/Testbladefile', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();

        $tables = DB::select('SHOW TABLES');

        return view('Test', [
            'connected' => true,
            'database' => $dbName,
            'tables' => $tables,
            'error' => null,
        ]);
    } catch (\Exception $e) {
        return view('Test', [
            'connected' => false,
            'database' => null,
            'tables' => [],
            'error' => $e->getMessage(),
        ]);
    }
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
