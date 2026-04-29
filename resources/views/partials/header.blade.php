<div class="wrapper">
        <header>
            <div class="header-start">
                <div class="logo" onclick="window.location='{{ route('index') }}'">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </div>
                <button class="catalog-header">Каталог</button>
        <div class="catalog-dropdown">
           @foreach($categories as $cat)
            <a href="{{ route('catalog', ['slug' => $cat->slug]) }}" class="catalog-item">
                <img src="{{ asset('images/' . $cat->image) }}" alt="{{ $cat->name }}">
                <span>{{ $cat->name }}</span>
            </a>
        @endforeach
        </div>
            </div>
            <div class="header-center">
                <form action="{{ route('catalog') }}" method="GET" class="search">
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Поиск"
                        value="{{ request('q') }}"
                    >

                    <button type="submit" class="button-search">
                        <img src="{{ asset('images/magnifier.png') }}" alt="magnifier">
                    </button>
                </form>
            </div>
            <div class="header-end">
                <div class="cart-header">
                    <button class="button-cart" onclick="location.href='{{ auth()->check() ? url('/cart') : route('auth.show') }}'"><img src="{{ asset('images/cart1.png') }}" alt="cart"></button>
                </div>
                <div class="profile" onclick="location.href='{{ auth()->check() ? (auth()->user()->role_id == 1 ? route('admin.index') : route('profile.show')) : route('auth.show') }}'">
                    <span>
                        @auth
                            {{ auth()->user()->role_id == 1 ? 'Администратор' : auth()->user()->name }}
                        @else
                            Войти
                        @endauth
                    </span>
                </div>
            </div>
        </header>