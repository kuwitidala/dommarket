@extends('layouts.app')

@section('title', 'DOM market')

@section('content')
    <script src="{{ asset('js/script.js') }}"></script>

        <main class="catalog-main">
            <h2 class="section-title">Каталог товаров</h2>
            <div class="cards-row">
                @forelse($products as $product)
                <div class="card" >
                    <div class="card-content" onclick="window.location='{{ route('product.show', $product->id) }}'">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="card-text">
                            <p class="price">{{ $product->price }} P</p>
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="shop-name">{{ $product->shop->name ?? 'Магазин' }}</p>
                            <p class="rating">⭐ {{ $product->rating }} ({{ $product->reviews_count }} отзывов)</p>
                        </div>
                    </div>
                    @if(auth()->check())
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-buy"
                                    onclick="alert('Товар добавлен в корзину')">
                                Купить
                            </button>
                        </form>
                    @else
                        <form onsubmit="return false;">
                            <button type="button" class="btn-buy"
                                    onclick="alert('Чтобы добавить товар в корзину, войдите в профиль')">
                                Купить
                            </button>
                        </form>
                    @endif
                </div>
                @empty
                    <p>Товаров нет в этой категории.</p>
                @endforelse
            </div>

            <div class="show-more">
                <button>Показать больше</button>
            </div>
        </main>
    <script src="{{ asset('js/catalog.js') }}"></script>

@endsection
