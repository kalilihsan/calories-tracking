<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealController;
use App\Models\Meal;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/meals/store', [MealController::class, 'save']);
Route::delete('/meals/{id}', [MealController::class, 'destroy']);
Route::put('/meals/{id}', [MealController::class, 'update']);

Route::get('/dashboard', function () {
    $meals = Meal::where('user_id', auth()->user()->id)->get();
    return view('dashboard', compact('meals'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
