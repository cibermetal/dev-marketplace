<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;

use App\Http\Controllers\UsersController;
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
    return view('welcome');
});


Route::get('/home', [MarketplaceController::class, 'index'])->middleware(['auth', 'permissions','verified'])->name('home.index');

//Route::get('/dashboard', [MarketplaceController::class, 'index'])->middleware(['auth', 'permissions', 'verified'])->name('dashboard');
Route::get('/dashboard', [MarketplaceController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('/success/{CHECKOUT_SESSION_ID}', [MarketplaceController::class, 'success'])->name('marketplace.success');
    Route::get('/mis-productos', [MarketplaceController::class, 'misProductos'])->name('marketplace.misproductos');


    Route::get('/usuarios', [UsersController::class, 'index'])->name('usuarios.index');
    Route::resource('users', UsersController::class);

    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);

});



require __DIR__.'/auth.php';
