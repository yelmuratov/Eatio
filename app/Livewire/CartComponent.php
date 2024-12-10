<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Food;
use Illuminate\Support\Facades\Session;

class CartComponent extends Component
{
    public $cartItems = [];
    public $cartCount = 0;
    public $quantities = [];

    public function mount()
    {
        $cart = Session::get('cart', []);
        $this->cartItems = Food::whereIn('id', array_keys($cart))->get()->map(function ($item) use ($cart) {
            $item->quantity = $cart[$item->id];
            return $item;
        });
        $this->cartCount = array_sum($cart);
    }

    public function removeItem($itemId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            Session::put('cart', $cart);
            $this->mount(); 
        }
    }

    public function render()
    {
        return view('livewire.cart-component', ['cartCount' => $this->cartCount])->layout('components.layouts.user');
    }

    public function incrementQuantity($itemId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$itemId])) {
            $cart[$itemId]++;
            Session::put('cart', $cart);
            $this->mount(); // Recalculate cart items and count
        }
    }

    public function decrementQuantity($itemId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$itemId])) {
            $cart[$itemId]--;
            if ($cart[$itemId] <= 0) {
                unset($cart[$itemId]);
            }
            Session::put('cart', $cart);
            $this->mount(); // Recalculate cart items and count
        }
    }
}