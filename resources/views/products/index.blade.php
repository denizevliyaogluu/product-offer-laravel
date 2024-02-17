<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Ürün Listesi</h2>

    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">Ürün Ekle</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Sepete Git</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Ürün Adı</th>
                <th>Açıklama</th>
                <th>Fiyat</th>
                <th>Kategori</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if($product->getCategory)
                            {{ $product->getCategory->name }}
                        @else
                            Kategori Yok
                        @endif
                    </td>
                    <td>
                        @if(Auth::check() && $product->user_id == Auth::id())
                            <a href="{{ route('products.update', ['id' => $product->id]) }}" class="btn btn-primary btn-sm">Düzenle</a>
                            <a href="{{ route('products.delete', $product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">Sil</a>
                            @else
                            <form action="{{ route('orders.create') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-success btn-sm">Sepete Ekle</button>
                            </form>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
