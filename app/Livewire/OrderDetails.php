<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderItem;
use App\Models\Food;

class OrderDetails extends Component
{
    public $orderItems;
    public $foods;

    public function mount($orderId)
    {
        $this->orderItems = OrderItem::where('order_id', $orderId)->get();
        $this->foods = Food::all();
    }

    public function render()
    {
        return view('livewire.order-details')->layout('components.layouts.app');
    }
}
