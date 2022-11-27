<?php
use Illuminate\Support\Facades\Route;
//memanggil file controller
use App\Http\Controllers\HomeController;
//route sebelumnya
// Route::get('/', function () {
// return view('frontpage.landingpage');
// });
//route yang terbaru
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
   })->middleware(['auth'])->name('dashboard');
   require __DIR__.'/auth.php';