<?php

use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.app.dashboard-home');
});





Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.app.dashboard-siakad', ['type_menu' => '']);
    })->name('home');
    Route::resource('user', UserController::class);
});

Route::get('/api/kesehatan', function () {
    return response()->json(App\Models\Kesehatan::all());
})->name('api.kesehatan');

Route::get('/data-tempat-kesehatan', [KesehatanController::class, 'showDataTempat'])->name('data.tempat.kesehatan');
Route::get('/tambah-data-kesehatan', [KesehatanController::class, 'create'])->name('tambah.data.kesehatan');
Route::post('/tambah-data-kesehatan', [KesehatanController::class, 'store']);
Route::get('/list-data-kesehatan', [KesehatanController::class, 'index'])->name('list.data.kesehatan');
// Route untuk menampilkan halaman edit
Route::get('/list-data-kesehatan/{id}/edit', [KesehatanController::class, 'edit'])->name('list.data.kesehatan.edit');
// Route untuk update data
Route::put('/list-data-kesehatan/{id}', [KesehatanController::class, 'update'])->name('list.data.kesehatan.update');
Route::delete('/list-data-kesehatan/{id}', [KesehatanController::class, 'destroy'])->name('list.data.kesehatan.destroy');