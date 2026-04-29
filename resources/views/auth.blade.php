@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
<section class="content">
        <main class="auth-page">
            <form class="auth-form" action = "{{route('auth.store')}}" method = "post">@csrf
                <h2 class="auth-title">Вход в аккаунт</h2>
                @if ($errors->any())
                    <div class="errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="email" class="auth-input" placeholder="Почта" name="email" required>
                <input type="password" class="auth-input" placeholder="Пароль" name="password" required>
                <button class="auth-btn" type="submit">Войти</button>
                <p class="auth-text">
                    Ещё не зарегистрированы?
                    <a href="{{ url('/regist') }}" class="auth-link">Создать аккаунт</a>
                </p>
            </form>
        </main>
    </section>
@endsection
