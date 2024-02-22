<header class="bg-dark text-light py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>E-Commerce</h1>
            <nav>
                <ul class="list-unstyled mb-0 d-flex">
                    @if (Auth::check())
                        @if (Auth::user()->role === 'company')
                            <li class="mr-3"><a href="{{ route('productmanagement.index') }}" class="text-light">Product Management</a></li>
                            {{-- <li class="mr-3"><a href="{{ route('productmanagement.orderdetails') }}" class="text-light">Gelen Siparişler</a></li> --}}
                        @else
                            <li class="mr-3"><a href="{{ route('homepage') }}" class="text-light">Home Page</a></li>
                            <li class="mr-3"><a href="{{ route('products.index') }}" class="text-light">Products</a>
                            </li>
                            <li class="mr-3"><a href="{{ route('orders.index') }}" class="text-light">Cart</a></li>
                        @endif
                    @endif
                </ul>
            </nav>
        </div>
        @if (Auth::check())
            <div class="text-light mt-2">{{ Auth::user()->name }} | <a href="{{ route('auth.logout') }}"
                    class="text-light"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
            </div>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="text-light">Sign In</a>
        @endif
    </div>
</header>
