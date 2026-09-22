<?php

use App\Http\Controllers\KitchenOrderItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\POSController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/test-order', function () {
    return view('test-order');
})->middleware('auth');

Route::get('/kitchen', [KitchenOrderItemController::class, 'index'])->middleware('auth');

Route::post(
    '/kitchen/{kitchenOrder}/start',
    [KitchenOrderItemController::class, 'start']
)->middleware(['auth', 'cook']);

Route::post(
    '/kitchen/{kitchenOrder}/complete',
    [KitchenOrderItemController::class, 'complete']
)->middleware(['auth', 'cook']);

Route::post(
    '/orders/{order}/complete',
    [OrderController::class, 'completeOrder']
)->middleware(['auth', 'cook']);

Route::get('/pos', [POSController::class, 'index'])->middleware('auth');


require __DIR__ . '/auth.php';
