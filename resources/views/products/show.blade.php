<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Ürün Detayı</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

@include('layouts.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }} Image" class="product-image">
        </div>
        <div class="col-md-6 mb-4">
            <h2>{{ $product->name }}</h2>
            <p><strong>Açıklama:</strong> {{ $product->description }}</p>
            <p><strong>Fiyat:</strong> {{ $product->price }}</p>
            <p><strong>Kategori:</strong>
                @if($product->getCategory)
                    {{ $product->getCategory->name }}
                @else
                    Kategori Yok
                @endif
            </p>
            <form action="{{ route('orders.create') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-lg btn-success">Sepete Ekle</button>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
