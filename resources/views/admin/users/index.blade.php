
@extends('layouts.app')

@section('title', 'пользователи')

@section('content')

<section class="content">
    <div class="product-admin-list">
        <h2>Список пользователей</h2>

            @foreach($users as $user)
            <div class="admin-product-card">

                <div class="admin-product-info">
                    <p class="admin-product-title">имя: {{ $user->name }}</p>
                    <p class="admin-product-author">почта: {{ $user->email }}</p>
                    <p class="admin-product-price">телефон: {{ $user->phone}}</p>
                    <p>ID: {{ $user->id }}</p>
                </div>

                <div>
                    <form action="{{ url('/admin/users/'.$user->id) }}" method="POST" style="display:inline">
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