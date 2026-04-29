@extends('layouts.app')

@section('title', 'Личный кабинет')

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
            <div class="profile-container">
               
                <aside class="profile-sidebar">
                <nav>
                    <ul>
                        <li>
                            @if(auth()->user()->shop)
                                <a href="{{ route('shop.dashboard') }}" class="sidebar-link active">Мой магазин</a>
                            @else
                                <a href="{{ route('shop.create') }}" class="sidebar-link active">Создать магазин</a>
                            @endif
                        </li>
                        <li><a href="{{ url('/cart') }}" class="sidebar-link">Корзина</a></li>
                        <li><a href="{{ url('/order') }}" class="sidebar-link">Заказы</a></li>
                    </ul>
                </nav>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Выйти</button>
                </form>
                </aside>

                <form class="profile-form" action="{{ route('user.update', auth()->id()) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name">Имя</label>
                <input type="text" id="name" name="name" placeholder="Ваше имя" value="{{ old('name', auth()->user()->name) }}" required>

                <label for="email">Почта</label>
                <input type="email" id="email" name="email" placeholder="Ваш email" value="{{ old('email', auth()->user()->email) }}" required>

                <label for="phone">Номер телефона</label>
                <input type="phone" id="phone" name="phone" placeholder="+7 (_) _--" value="{{ old('phone', auth()->user()->phone ?? '') }}">

                <button type="submit" class="save-btn">Сохранить изменения</button>
            </form>
            </div>
        
        </main>
    </section>
@endsection