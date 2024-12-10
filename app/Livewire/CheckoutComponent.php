<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Food;
use Illuminate\Support\Facades\Session;

class CheckoutComponent extends Component
{
    public $cartItems = [];
    public $cartCount = 0;
    public $deliveryOption = 'delivery';

    public function mount()
    {
        $cart = Session::get('cart', []);
        $this->cartItems = Food::whereIn('id', array_keys($cart))->get()->map(function ($item) use ($cart) {
            $item->quantity = $cart[$item->id];
            return $item;
        });
        $this->cartCount = array_sum($cart);
    }

    public function render()
    {
        return view('livewire.checkout-component', [
            'cartCount' => $this->cartCount,
            'deliveryOption' => $this->deliveryOption
        ])->layout('components.layouts.user');
    }

    public function updatedDeliveryOption($value)
    {
        $this->deliveryOption = $value;
    }
}