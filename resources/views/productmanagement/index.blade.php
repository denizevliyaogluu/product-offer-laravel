<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')


    <div class="container">
        <h1>Product Management</h1>

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('products.create') }}" class="btn btn-dark">Create Product</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Operations</th>
                    <th scope="col">Offers</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="{{ $product->first_image }}" class="card-img-top" alt="{{ $product->name }} Image"
                                style="max-width: 100px;"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <a href="{{ route('products.update', $product->uniqid) }}"
                                class="btn btn-secondary btn-sm">Update</a>
                            <form action="{{ route('products.delete', $product->uniqid) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-dark btn-sm"
                                    onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">Delete</button>
                            </form>
                        </td>
                        {{-- <td>
                            <a href="{{ route('product.order.details', $product->id) }}"
                                class="btn btn-primary btn-sm">Orders</a>
                        </td> --}}
                        <td>
                            <a href="{{ route('product.offers.details', $product->id) }}"
                                class="btn btn-primary btn-sm">Offers</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
