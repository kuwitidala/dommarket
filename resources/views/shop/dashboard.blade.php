@extends('layouts.app')

@section('title', 'Кабинет магазина')

@section('content')
<section class="content">
    <main class="profile-page">

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="shop-profile-container">
            <form class="shop-profile-form" method="POST" action="{{ route('shop.update') }}" enctype="multipart/form-data">
                @csrf

                <h2>Информация о магазине</h2>

                <label>Название магазина</label>
                <input type="text" name="name" value="{{ old('name', $shop->name) }}">

                <label>Описание</label>
                <textarea name="description">{{ old('description', $shop->description) }}</textarea>

                <label>Фото магазина</label>
                @if($shop->image)
                <img src="{{ asset('images/shops/' . $shop->image) }}" width="120">
            @endif
            <input type="file" name="image">

                <button type="submit" class="save-btn">Сохранить</button>
            </form>
        </div>
        
        <section class="shop-products">
            <a href="{{ route('product.create') }}" class="save-btn">
                + Добавить товар
            </a>
            <h2>Мои товары</h2>

            <div class="cards-row">
                @forelse($products as $product)
                <div class="card" onclick="window.location='{{ route('product.show', $product->id) }}'">
                    <div class="card-content">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="card-text">
                            <p class="price">{{ $product->price }} P</p>
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="shop-name">{{ $product->shop->name ?? 'Магазин' }}</p>
                            <p class="rating">⭐ {{ $product->rating }} ({{ $product->reviews_count }} отзывов)</p>
                            <div>
                                <form action="{{ route('shop.product.delete', $product->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method ('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить?')" class="cart-button shop">Удалить</button>
                                </form>
                            </div>
                            <div>
                                <form action="{{ route('product.edit', $product->id) }}" method="GET" style="display:inline">
                                        @csrf
                                        <button type="submit" class="cart-button shop">Редактировать</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <p>Товаров нет в этой категории.</p>
                @endforelse
            </div>
        </section>

    </main>
</section>
@endsection