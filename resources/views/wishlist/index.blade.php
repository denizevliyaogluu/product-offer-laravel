<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')

    <div class="container mt-5">
        <h2 class="mb-4">My Wishlist</h2>

        <div class="row">
            @foreach ($favorites as $favorite)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('products.show', $favorite->product->uniqid) }}">
                        <img src="{{ asset('images/' . $favorite->product->images->first()->image) }}"
                            class="card-img-top" alt="{{ $favorite->product->name }} Image">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('products.show', $favorite->product->uniqid) }}"
                                class="text-decoration-none">{{ $favorite->product->name }}</a>
                        </h5>
                        <p class="card-text">{{ $favorite->product->description }}</p>
                        <p class="card-text">Price: {{ $favorite->product->price }}</p>
                        <p class="card-text">Category: {{ $favorite->product->getCategory->name }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
