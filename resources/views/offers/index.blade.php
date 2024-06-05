<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')

    <div class="container mt-5">
        <h1>Offers</h1>
        @if($userOffers->isEmpty())
            <p>You haven't made any offers yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>User</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userOffers as $offer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('products.show', $offer->product->uniqid) }}">{{ $offer->product->name }}</a></td>
                            <td>
                                <a href="#" class="user-info-link" data-toggle="modal" data-target="#userModal"
                                   data-name="{{ $offer->user->name }}"
                                   data-surname="{{ $offer->user->surname }}"
                                   data-email="{{ $offer->user->email }}"
                                   data-phone="{{ $offer->user->phone }}">
                                   User Details
                                </a>
                            </td>
                            <td>{{ $offer->price }}</td>
                            <td>{{ $offer->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- User Info Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="modalUserName"></span></p>
                    <p><strong>Surname:</strong> <span id="modalUserSurname"></span></p>
                    <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>
                    <p><strong>Phone:</strong> <span id="modalUserPhone"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.user-info-link').on('click', function(){
                var name = $(this).data('name');
                var surname = $(this).data('surname');
                var email = $(this).data('email');
                var phone = $(this).data('phone');

                $('#modalUserName').text(name);
                $('#modalUserSurname').text(surname);
                $('#modalUserEmail').text(email);
                $('#modalUserPhone').text(phone);
            });
        });
    </script>

</body>

</html>
