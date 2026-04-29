@extends('layouts.app')

@section('title', 'DOM market')

@section('content')
    <script src="{{ asset('js/script.js') }}"></script>

        <main class="catalog-main">
            <h1>{{ $shop->name }}</h1>

            <p class="shop-description">{{ $shop->description }}</p>
            <script>
                const SHOP_ID = {{ $shop->id }};
            </script>
            <div class="cards-row" id="shop-products-container">
                
            </div>

            <div class="show-more" id="shop-show-more">
                <button>Показать больше</button>
            </div>
        </main>
    <script src="{{ asset('js/catalog.js') }}"></script>
    <script src="{{ asset('js/shop.js') }}"></script>
<script>
    const csrfToken = '{{ csrf_token() }}';
</script>
<script>
    const isAuth = {{ auth()->check() ? 'true' : 'false' }};
</script>
@endsection
