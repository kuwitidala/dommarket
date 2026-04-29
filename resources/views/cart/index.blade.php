@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<section class="content">
    <main class="cart-content">
        <h2 class="cart-title">Корзина</h2>

        @if($cartItems->isEmpty())
            <p>Корзина пуста</p>
        @else

            <div class="cart-items-wrapper">

                @foreach($cartItems as $item)
                    <div class="cart-item">
                        <input type="checkbox"
                               class="order-checkbox"
                               value="{{ $item->id }}">

                        <img src="{{ asset('images/products/' . $item->product->image) }}"
                             alt="{{ $item->product->name }}"
                             class="cart-item__image">

                        <div class="cart-item__info">
                            <p class="cart-item__title">{{ $item->product->name }}</p>
                            <p class="cart-item__author">{{ $item->product->author }}</p>
                            <p>{{ $item->product->price }} ₽</p>
                        </div>
                        <div class="cart-item__quantity">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="number"
                                       name="quantity"
                                       value="{{ $item->quantity }}"
                                       min="1">

                                <button type="submit" class="cart-button">Обновить</button>
                            </form>
                        </div>
                        <div class="cart-item__remove">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="cart-button">Удалить</button>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf
                <div id="selectedItemsContainer"></div>

                <div class="cart-footer">
                    <label>
                        Адрес доставки <span style="color:red">*</span>
                    </label>

                    <input type="text" name="address" class="cart-address" placeholder="Введите ваш адрес" required>

                    <div class="cart-total">
                        <strong>Итого: {{ $total }} ₽</strong>
                    </div>

                    <button type="submit" class="cart-order-btn">
                        Оформить заказ
                    </button>
                </div>
            </form>

        @endif
    </main>
</section>

<script>
document.getElementById('orderForm').addEventListener('submit', function () {

    const container = document.getElementById('selectedItemsContainer');
    container.innerHTML = '';

    const checkedItems = document.querySelectorAll('.order-checkbox:checked');

    if (checkedItems.length === 0) {
        alert('Выберите хотя бы один товар!');
        event.preventDefault();
        return;
    }

    checkedItems.forEach(function (checkbox) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_items[]';
        input.value = checkbox.value;
        container.appendChild(input);
    });

});
</script>

@endsection