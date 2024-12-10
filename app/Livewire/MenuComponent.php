<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class MenuComponent extends Component
{   
    public $foods;
    public $categories;
    public $cartCount = 0;
    public $quantities = [];
    public $cart = [];

    public function mount()
    {
        $this->cart = Session::get('cart', []);
        $this->cartCount = array_sum($this->cart);
    }

    public function render()
    {   
        $this->foods = Food::all();
        $this->categories = Category::all();
        return view('livewire.menu-component', ['cartCount' => $this->cartCount])->layout('components.layouts.user');
    }

    public function addToCart($foodId)
    {
        $quantity = $this->quantities[$foodId] ?? 1;
        if (isset($this->cart[$foodId])) {
            $this->cart[$foodId] += $quantity;
        } else {
            $this->cart[$foodId] = $quantity;
        }
        Session::put('cart', $this->cart);
        $this->cartCount = array_sum($this->cart);
    }
}
