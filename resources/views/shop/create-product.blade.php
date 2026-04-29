@extends('layouts.app')

@section('title', 'Создать товар')

@section('content')
<section class="content">
       <main class="auth-page">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="auth-form">
                @csrf
                <label>Название товара</label>
                <input type="text" name="name" class="auth-input" placeholder="Название" required>
                <label>Описание</label>
                <textarea name="description" class="auth-input" placeholder="Описание" required></textarea>
                <label>Цена</label>
                <input type="number" class="auth-input" name="price" placeholder="Цена" required>
                <label>Категория</label>
                <select name="category_id" class="auth-input" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <label>Материалы</label>
                <input type="text" class="auth-input" name="material" placeholder="Материалы" required>
                <label>Фото</label>
                <input type="file" name="image" required>

                <button type="submit" class="auth-btn">Создать товар</button>
            </form>
        </main>
    </section>
@endsection