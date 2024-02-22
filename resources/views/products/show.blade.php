<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Product Detail</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image {
            max-width: 100%;
            height: 400px; /* Ayarlamak istediğiniz boyut */
            object-fit: cover; /* Resmi kesmeden boyutları koruyarak tamamen doldurur */
        }
    </style>
</head>
<body>

@include('layouts.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            @if ($product->images)
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($product->images as $key => $image)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($product->images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/' . $image->image) }}" class="d-block w-100 product-image" alt="{{ $product->name }} Image">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @else
                <p>No images available.</p>
            @endif
        </div>
        <div class="col-md-6 mb-4">
            <h2>{{ $product->name }}</h2>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> {{ $product->price }}</p>
            <p><strong>Category:</strong>
                @if($product->getCategory)
                    {{ $product->getCategory->name }}
                @else
                    No Category
                @endif
            </p>
            <form action="{{ route('orders.create') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-lg btn-dark">Add to Cart</button>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Comments</h3>
            @if($product->comments->count() > 0)
                <ul class="list-group">
                    @foreach($product->comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No comments yet.</p>
            @endif
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Add Comment</h3>
            <form action="{{ route('products.add.comment', $product->uniqid) }}" method="post">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment here"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
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
