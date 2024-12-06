<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Livewire\CategoryComponent;
use App\Livewire\DashboardComponent;
use App\Livewire\FoodComponent;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/admin', DashboardComponent::class)->name('admin');
Route::get('/dashboard', function() {
    return redirect()->route('index');
})->middleware(['auth'])->name('dashboard');


// Category Routes
Route::get('/categories',CategoryComponent::class)->name('categories');


// Food Routes
Route::get('/foods',FoodComponent::class)->name('foods');


