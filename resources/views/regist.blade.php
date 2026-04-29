@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<section class="content">
       <main class="auth-page">
            <form class="auth-form" action="{{route ('regist.store')}}" method="POST">@csrf
                <h2 class="auth-title">Регистрация</h2>
                @if ($errors->any())
                    <div class="errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input name="name" type="text" class="auth-input" placeholder="Имя" required>
                <input name="email"type="email" class="auth-input" placeholder="Почта" required>

                <input name="password" type="password" class="auth-input" placeholder="Пароль" required>
                <input type="password" name="password_confirmation" class="auth-input" placeholder="Повторите пароль" required>

                <button type="submit" class="auth-btn">Создать аккаунт</button>

                <p class="auth-text">
                    Уже есть аккаунт?
                    <a href="{{ url('/auth') }}" class="auth-link">Войти</a>
                </p>
                
            </form>
        </main>
    </section>
@endsection