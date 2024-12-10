<div class="container-fluid">
    <!-- Orders Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Orders</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ordersTable" class="table table-responsive-sm">
                            <input type="text" class="form-control" placeholder="Search Orders..." wire:model.debounce.500ms="searchTerm">
                            <h1>{{$searchTerm}}</h1>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Total</th>
                                    <th>Payment Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach($orders as $order)
                                    <tr style="cursor: pointer;">
                                        <td onclick="window.location='{{ route('order.details', ['orderId' => $order->id]) }}'">{{ $order->id }}</td>
                                        <td onclick="window.location='{{ route('order.details', ['orderId' => $order->id]) }}'">{{ $order->user_id }}</td>
                                        <td onclick="window.location='{{ route('order.details', ['orderId' => $order->id]) }}'">{{ $order->total }}</td>
                                        <td onclick="window.location='{{ route('order.details', ['orderId' => $order->id]) }}'">{{ $order->payment_type }}</td>
                                        <td>
                                            <select wire:change.prevent="updateOrderStatus({{ $order->id }}, $event.target.value)" wire:model="order.status" onclick="event.stopPropagation()" class="form-select">
                                                <option value="pending" class="text-warning" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" class="text-success" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" class="text-danger" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Controls -->
                    <div id="paginationControls" class="mt-3 text-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
