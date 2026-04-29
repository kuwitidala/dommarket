@extends('layouts.app')

@section('title', $product->name)

@section('content')

<main class="product-page">

    <section class="product-top">
        
        <div class="product-left">
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="product-meta">
                Бренд: {{ $product->shop->name ?? 'Магазин' }} | ⭐️ {{ $product->rating }}
            </p>
            <div class="product-image">
                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" >
            </div>
            
        </div>

        <div class="product-right">
            <p class="product-price">₽{{ $product->price }}</p>

            @if(auth()->check())
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-buy-detail"
                            onclick="alert('Товар добавлен в корзину')">
                        Купить
                    </button>
                </form>
            @else
                <form onsubmit="return false;">
                    <button type="button" class="btn-buy-detail"
                            onclick="alert('Чтобы добавить товар в корзину, войдите в профиль')">
                        Купить
                    </button>
                </form>
            @endif

            <p class="product-info">Артикул: {{ $product->article }}</p>
            <p class="product-info">Материалы: {{ $product->material }}</p>
            <p class="product-info">Магазин: <a class="product-info-shop-link" href="{{ route('shop.show', $product->shop->id) }}">{{ $product->shop->name }}</a></p>
        </div>

    </section>

    <section class="product-description">
        <h2 class="section-title">Описание</h2>
        <p class="product-description">{{ $product->description }}</p>
    </section>
    <div class="reviews">

    <div class="review-add">
        <form method="POST" action="/product/{{ $product->id }}/review" class="review-form">
            @csrf

            <div class="form-group">
                <label>Оценка</label>
                <select name="rating">
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★</option>
                    <option value="3">★★★</option>
                    <option value="2">★★</option>
                    <option value="1">★</option>
                </select>
            </div>

            <div class="form-group">
                <label>Отзыв</label>
                <textarea name="text" placeholder="Напишите ваш отзыв..."></textarea>
            </div>

            <button type="submit">Оставить отзыв</button>
        </form>
    </div>

    <div class="review-list">
        @foreach($product->reviews as $review)
            <div class="review-item">
                <div class="review-top">
                    <b>{{ $review->user->name }}</b>
                    <span class="stars">⭐ {{ $review->rating }}</span>
                </div>
                <p>{{ $review->text }}</p>
            </div>
        @endforeach
    </div>

</div>
    <section class="product-brand">
        <h2 class="section-title">Другие товары бренда</h2>

        <div class="cards-row">
            @foreach($brandProducts as $p)
                <div class="card" onclick="window.location='{{ route('product.show', $p->id) }}'">
                    <div class="card-content">
                        <img src="{{ asset('images/products/' . $p->image) }}" alt="{{ $p->name }}">
                        <div class="card-text">
                            <p class="price">₽{{ $p->price }}</p>
                            <p class="product-name">{{ $p->name }}</p>
                            <p class="shop-name">{{ $p->shop->name ?? 'Магазин' }}</p>
                            <p class="rating">⭐ {{ $p->rating }} ({{ $p->reviews_count }} отзывов)</p>
                        </div>
                    </div>
                    <button class="btn-buy">Купить</button>
                </div>
            @endforeach
        </div>
    </section>
</main>

<script src="{{ asset('js/catalog.js') }}"></script>

@endsection