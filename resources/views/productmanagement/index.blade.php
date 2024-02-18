<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')


    <div class="container">
        <h1>Ürün Yönetimi</h1>

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('products.create') }}" class="btn btn-dark">Ürün Ekle</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ürün Resmi</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Fiyat</th>
                    <th scope="col">Açıklama</th>
                    <th scope="col">İşlemler</th>
                    <th scope="col">Siparişler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
    <tr>
        <td><img src="{{ asset('images/' . $product->image) }}" class="card-img-top"
                alt="{{ $product->name }} Image" style="max-width: 100px;"></td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->description }}</td>
        <td>
            <a href="{{ route('products.update', $product->uniqid) }}"
                class="btn btn-secondary btn-sm">Düzenle</a>
            <form action="{{ route('products.delete', $product->uniqid) }}" method="POST"
                class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-dark btn-sm"
                    onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">Sil</button>
            </form>
        </td>
        <td>
            <ul>
                @foreach ($product->orders as $order)
                    Sipariş Numarası: {{ $order->id }}
                @endforeach
            </ul>
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
