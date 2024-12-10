<div class="container">
    <h1>Order Details</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        @foreach($foods as $food)
                            @if($food->id == $item->food_id)
                                {{ $food->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>