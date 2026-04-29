@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
<section class="content">
    <main class="orders-content">
        <h2 class="orders-title">Мои заказы</h2>

        @if($orders->isEmpty())
            <p>У вас пока нет оформленных заказов.</p>
        @else
            @foreach($orders as $order)
                <div class="order-block">
                    <h3>Заказ №{{ $order->id }} — {{ $order->created_at->format('d.m.Y H:i') }}</h3>
                    <p>Адрес доставки: {{ $order->address }}</p>

                    @foreach($order->items as $item)
                        <div class="order-item">
                            <img src="{{ asset('images/products/' . $item->product->image) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="order-item__image">

                            <div class="order-item__info">
                                <p class="order-item__title">{{ $item->product->name }}</p>
                                <p class="order-item__author">{{ $item->product->author }}</p>
                                <p>Количество: {{ $item->quantity }}</p>
                            </div>

                            <div class="order-item__right">
                                <p class="order-item__price">{{ $item->price * $item->quantity }} ₽</p>
                                <p class="order-itemstatus order-itemstatus--success">
                                    Оформлен
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <div class="order-total">
                        <strong>Итого по заказу: {{ $order->total }} ₽</strong>
                    </div>
                    <hr>
                </div>
            @endforeach
        @endif

    </main>
</section>
@endsection