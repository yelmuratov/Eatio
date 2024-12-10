<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Livewire\CategoryComponent;
use App\Livewire\DashboardComponent;
use App\Livewire\FoodComponent;
use App\Livewire\MenuComponent;
use App\Livewire\CartComponent;
use App\Livewire\CheckoutComponent;
use App\Livewire\OrderComponent;
use App\Livewire\OrderDetails;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/admin', DashboardComponent::class)->name('admin');
Route::get('/dashboard', function() {
    return redirect()->route('index');
})->middleware(['auth'])->name('dashboard');


// Category Routes
Route::get('/categories',CategoryComponent::class)->name('categories');


// Food Routes
Route::get('/foods',FoodComponent::class)->name('foods');
Route::get('/menu', MenuComponent::class)->name('menu');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/orders', OrderComponent::class)->name('orders');
Route::get('/order-details/{orderId}', OrderDetails::class)->name('order.details');


