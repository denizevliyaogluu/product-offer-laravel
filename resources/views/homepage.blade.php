<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h3>Categories</h3>
                <div class="list-group">
                    <a href="{{ route('homepage') }}" class="list-group-item list-group-item-action">All Categories</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('homepage', ['category_id' => $category->id]) }}"
                            class="list-group-item list-group-item-action">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-md-8">
                <h3>Products</h3>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <a href="{{ route('products.show', $product->uniqid) }}">
                                    <img src="{{ $product->first_image }}" class="card-img-top"
                                        alt="{{ $product->name }} Image">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->price }} ₺</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
