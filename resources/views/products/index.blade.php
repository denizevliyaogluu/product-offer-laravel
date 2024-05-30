<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')

    <div class="container mt-5">
        <h2 class="mb-4">Product List</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach ($products as $product)
                @php
                    $firstImage = $product->images()->first();
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <a href="{{ route('products.show', $product->uniqid) }}">
                            @if ($firstImage)
                                <img src="{{ asset('images/' . $firstImage->image) }}" class="card-img-top"
                                    alt="{{ $product->name }} Image">
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" class="card-img-top"
                                    alt="Default Image">
                            @endif
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('products.show', $product->uniqid) }}"
                                    class="text-decoration-none">{{ $product->name }}</a>
                            </h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Price: {{ $product->price }}</p>
                            <p class="card-text">Category:
                                @if ($product->getCategory)
                                    {{ $product->getCategory->name }}
                                @else
                                    No Category
                                @endif
                            </p>
                            @if (auth()->check() &&
                                    auth()->user()->favorites &&
                                    auth()->user()->favorites->contains('product_id', $product->id))
                                <button class="btn btn-danger toggleFavoriteBtn" data-product-id="{{ $product->id }}"
                                    data-action="remove">
                                    <i class="fas fa-heart"></i>
                                </button>
                            @else
                                <button class="btn btn-danger toggleFavoriteBtn" data-product-id="{{ $product->id }}"
                                    data-action="add">
                                    <i class="fas fa-heart"></i>
                                </button>
                            @endif
                        </div>
                        {{-- <div class="card-footer">
                            <form action="{{ route('orders.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm btn-dark">Add to Cart</button>
                            </form>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.toggleFavoriteBtn').click(function() {
                var button = $(this);

                var productId = button.data('product-id');
                var action = button.data('action');

                $.ajax({
                    type: 'POST',
                    url: action === 'add' ? '{{ route('favorites.add') }}' :
                        '{{ route('favorites.remove') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'product_id': productId
                    },
                    success: function(response) {
                        alert(response.message);
                        if (action === 'add') {
                            button.html('<i class="fas fa-heart"></i>');
                            button.data('action', 'remove');
                            button.removeClass('btn-danger').addClass('btn-danger');
                        } else {
                            button.html('<i class="fas fa-heart"></i>');
                            button.data('action', 'add');
                            button.removeClass('btn-danger').addClass('btn-danger');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>


</body>

</html>
