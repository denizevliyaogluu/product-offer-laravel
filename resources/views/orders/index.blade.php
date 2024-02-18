<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('layouts.header')

<div class="container mt-5">
    <h2 class="mb-4">Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($pending_orders->count() > 0)
        <div class="card mb-3">
            <div class="card-header">Unconfirmed Order</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pending_orders as $order)
                            @foreach($order->getOrderItems as $order_item)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order_item->getProduct->name }}</td>
                                    <td>{{ $order_item->getProduct->price }}</td>
                                    <td>
                                        @if($order_item->getProduct->getCategory)
                                            {{ $order_item->getProduct->getCategory->name }}
                                        @else
                                            No Category
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <strong>Total Price: </strong><b>{{ $pending_orders->first()->total_amount }}</b>
                </div>
                <div class="mb-3">
                    <a href="{{ route('orders.confirmCart') }}" class="btn btn-success">Confirm Cart</a>
                </div>
            </div>
        </div>
    @endif

    @foreach($confirmed_orders as $order)
        <div class="card mb-3">
            <div class="card-header">Confirmed Order #{{ $order->id }}</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->getOrderItems as $order_item)
                            <tr>
                                <td>{{ $order_item->getProduct->name }}</td>
                                <td>{{ $order_item->getProduct->price }}</td>
                                <td>
                                    @if($order_item->getProduct->getCategory)
                                        {{ $order_item->getProduct->getCategory->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <strong>Total Price: </strong><b>{{ $order->total_amount }}</b>
                </div>
            </div>
        </div>
    @endforeach
</div>

@include('layouts.footer')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
