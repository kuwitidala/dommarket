@extends('layouts.app')

@section('title', 'Создать магазин')

@section('content')
<section class="content">
    <main class="auth-page">
        <form class="auth-form" action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h2 class="auth-title">Создать магазин</h2>
            <input name="name" type="text" class="auth-input" placeholder="Название магазина" required>
            <label>Фото</label>
            <input type="file" name="image" required>
            <button type="submit" class="auth-btn">Создать</button>
        </form>
    </main>
</section>
@endsection