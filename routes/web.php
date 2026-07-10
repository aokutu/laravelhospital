<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/carregister', function () {
    return view('carregister');
});

Route::get('/Testbladefile', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        
        // Try a simple query
        $tables = DB::select('SHOW TABLES');
        
        return view('Test', [          // <-- Changed to 'Test' to match your blade file
            'connected' => true,
            'database' => $dbName,
            'tables' => $tables,
            'error' => null
        ]);
    } catch (\Exception $e) {
        return view('Test', [          // <-- Changed to 'Test'
            'connected' => false,
            'database' => null,
            'tables' => [],
            'error' => $e->getMessage()
        ]);
    }
});






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
