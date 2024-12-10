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

    public function mount()
    {
        $this->cartCount = count(Session::get('cart', []));
    }

    public function render()
    {   
        $this->foods = Food::all();
        $this->categories = Category::all();
        return view('livewire.menu-component', ['cartCount' => $this->cartCount])->layout('components.layouts.user');
    }

    public function addToCart($foodId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$foodId])) {
            $cart[$foodId]++;
        } else {
            $cart[$foodId] = 1;
        }
        Session::put('cart', $cart);
        $this->cartCount = array_sum($cart);
    }
}
