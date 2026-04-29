@extends('layouts.app')

@section('title', 'Редактировать товар')

@section('content')
<section class="content">
       <main class="auth-page">
            <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" class="auth-form">
            @csrf
            @method('PUT')
                <label>Название товара</label>
                <input type="text" name="name" class="auth-input" placeholder="Название" value="{{old('name', $product->name)}}" required>
                <label>Описание</label>
                <textarea name="description" class="auth-input" placeholder="Описание"  required>{{old('descriprion', $product->description)}}</textarea>
                <label>Цена</label>
                <input type="number" class="auth-input" name="price" placeholder="Цена" value="{{old('price', $product->price)}}" required>
                <label>Категория</label>
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <label>Материалы</label>
                <input type="text" class="auth-input" name="material" placeholder="Материалы" value="{{old('material', $product->material)}}" required>
                <label>Фото</label>
                @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" width="120">
                @endif
                <input type="file" name="image">

                <button type="submit" class="auth-btn">Редактировать</button>
            </form>
        </main>
    </section>
@endsection