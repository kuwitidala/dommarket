@extends('layouts.app')

@section('title', 'Книжный дом')

@section('content')
    <section class="feedback-section">
        <h2 class="feedback-title">Обратная связь</h2>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form class="feedback-form" action="{{route('feedback.store')}}" method = "POST">@csrf
            <div class="inputs-row">
            <input class="feedback-input" type="text" name="name" placeholder="Ваше имя" required>
            <input class="feedback-input" type="email" name="email" placeholder="Ваша почта" required>
            </div>
            <textarea class="feedback-textarea" name="message" placeholder="Ваш отзыв" rows="5" required></textarea>
            <button class="feedback-button" type="submit">Отправить</button>
        </form>
    </section>
@endsection