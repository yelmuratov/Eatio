<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class OrderComponent extends Component
{
    use WithPagination;

    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $orders = Order::where('id', 'like', $searchTerm)
                        ->orWhere('user_id', 'like', $searchTerm)
                        ->orWhere('total', 'like', $searchTerm)
                        ->orWhere('payment_type', 'like', $searchTerm)
                        ->orWhere('status', 'like', $searchTerm)
                        ->paginate(10);

        return view('livewire.order-component', ['orders' => $orders])->layout('components.layouts.app');
    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->status = $status;
            $order->save();
        }
    }
}
