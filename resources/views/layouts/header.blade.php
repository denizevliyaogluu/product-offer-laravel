<header class="bg-dark text-light py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Deniz E-Ticaret</h1>
            <nav>
                <ul class="list-unstyled mb-0 d-flex">
                    @if (Auth::check())
                        @if (Auth::user()->role === 'company')
                            <li class="mr-3"><a href="{{ route('productmanagement.index') }}" class="text-light">Ürün
                                    Yönetimi</a></li>
                            {{-- <li class="mr-3"><a href="{{ route('productmanagement.orderdetails') }}" class="text-light">Gelen Siparişler</a></li> --}}
                        @else
                            <li class="mr-3"><a href="{{ route('homepage') }}" class="text-light">Anasayfa</a></li>
                            <li class="mr-3"><a href="{{ route('products.index') }}" class="text-light">Ürünler</a>
                            </li>
                            <li class="mr-3"><a href="{{ route('orders.index') }}" class="text-light">Sepetim</a></li>
                        @endif
                    @endif
                </ul>
            </nav>
        </div>
        @if (Auth::check())
            <div class="text-light mt-2">{{ Auth::user()->name }} | <a href="{{ route('auth.logout') }}"
                    class="text-light"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıkış Yap</a>
            </div>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="text-light">Giriş Yap</a>
        @endif
    </div>
</header>
