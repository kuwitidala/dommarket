@extends('layouts.app')

@section('title', 'Заказы')

@section('content')

<section class="content">
    <div class="user-admin-list">
        <h2>Список заказов</h2>

        @foreach($orders as $order)
            <div class="admin-order-card">

                <div class="admin-order-header">
                    Заказ №{{ $order->id }}
                </div>

                <div class="admin-order-info">
                    <p><strong>Пользователь:</strong> {{ $order->user->name ?? 'Удалён' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
                    <p><strong>Адрес:</strong> {{ $order->address }}</p>
                    <p><strong>Дата:</strong> {{ $order->created_at }}</p>
                </div>

                <div class="admin-order-items">
                    <strong>Состав заказа:</strong>

                    @foreach($order->items as $item)
                        <div class="admin-order-item">
                            <span>
                                {{ $item->product->name ?? 'Товар удалён' }} — {{ $item->quantity }} шт.
                            </span>
                            <span>
                                {{ $item->price }} ₽
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="admin-order-total">
                    Итого: {{ $order->total }} ₽
                </div>
            </div>
        @endforeach

    </div>
</section>

@endsection