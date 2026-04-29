@extends('layouts.app')

@section('title', 'товары')

@section('content')

<section class="content">
    <div class="product-admin-list">
        <h2>Список товаров</h2>

        @foreach($products as $product)
            <div class="admin-product-card">

                <img src="{{ asset('images/products/' . $product->image) }}"
                     class="admin-product-image">

                <div class="admin-product-info">
                    <p class="admin-product-title">{{ $product->name }}</p>
                    <p class="admin-product-author">{{ $product->author }}</p>
                    <p class="admin-product-price">{{ $product->price }} ₽</p>
                    <p>ID: {{ $product->id }}</p>
                </div>

                <div>
                    <form action="{{ url('/admin/products/'.$product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('Удалить этот товар?')"
                                class="admin-btn">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection