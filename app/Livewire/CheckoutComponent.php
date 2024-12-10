<<<<<<< HEAD
=======
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Food;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class CheckoutComponent extends Component
{
    public $cartItems = [];
    public $cartCount = 0;
    public $paymentType = 'Credit Card';

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
            'cartItems' => $this->cartItems,
        ])->layout('components.layouts.user');
    }

    public function placeOrder(){
        $cart = Session::get('cart', []);
        
        foreach ($cart as $key => $value) {
            $food = Food::where('id',$key)->first();
            $quantity = $value;

            $order = Order::create([
                'user_id' => 1,
                'total'=> $food->price * $quantity,
                'status' => 'pending',
                'payment_type' => $this->paymentType,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $food->id,
                'quantity' => $quantity,
                'price' => $food->price,
                'status' => 'pending',
            ]);

            Session::forget('cart');
            $this->cartItems = [];
            $this->cartCount = 0;
            
            $flashMessage = 'Order placed successfully!';
            session()->flash('success', $flashMessage);
        }
    }
}
>>>>>>> my-new-branch
