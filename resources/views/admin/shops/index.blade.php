
@extends('layouts.app')

@section('title', 'магазины')

@section('content')

<section class="content">
    <div class="product-admin-list">
        <h2>Список магазинов</h2>

            @foreach($shops as $shop)
            <div class="admin-product-card">

                <img src="{{ asset('images/shops/' . $shop->image) }}"
                     class="admin-product-image">

                <div class="admin-product-info">
                    <p class="admin-product-title">имя: {{ $shop->name }}</p>
                    <p class="admin-product-author">описание: {{ $shop->description }}</p>
                    <p class="admin-product-price">рейтинг: {{ $shop->rating}}</p>
                    <p>ID: {{ $shop->id }}</p>
                </div>

                <div>
                    <form action="{{ url('/admin/shops/'.$shop->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" onclick="return confirm('Удалить?')" class="cart-button">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection