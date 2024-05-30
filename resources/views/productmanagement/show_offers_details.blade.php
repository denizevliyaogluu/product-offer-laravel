<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

@include('layouts.header')

<div class="container">
    <h1>{{ $product->name }} - Offer Details</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Owner</th>
                <th scope="col">Owner's Email</th>
                <th scope="col">Owner's Phone</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
            <tr>
                <td>{{ $offer->user->name }}</td>
                <td>{{ $offer->user->email }}</td>
                <td>{{ $offer->user->phone }}</td>
                <td>{{ $offer->price }}</td>
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
