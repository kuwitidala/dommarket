@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
<section class="content">
    <h1>Панель администратора</h1>
    <div class="admin-links">
        <a href="{{ route('admin.products') }}" >Список товаров</a>
        <a href="{{ route('admin.users') }}" >Список пользователей</a>
        <a href="{{ route('admin.orders') }}" >Список заказов</a>
        <a href="{{ route('admin.shops') }}" >Список магазинов</a>
    </div>
     <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Выйти</button>
    </form>
</section>
@endsection