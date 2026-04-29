@extends('layouts.app')

@section('title', 'DOM market')

@section('content')
<main>
    <div class="slider">
        <div class="slides">
            <img src="{{ asset('images/banner1.png') }}" alt="banner">
            <img src="{{ asset('images/banner2.png') }}" alt="banner">
        </div>
        <button class="btn prev">&#10094;</button>
        <button class="btn next">&#10095;</button>
    </div>

    <section class="section-new">
        <h2 class="section-title">Новинки</h2>
        <div class="cards-row">
            <div class="cards-row"id='products-container'>
               
            </div>
        </div>
        <div class="show-more">
            <button id="show-more">Показать больше</button>
        </div>
    </section>

    <section class="section-popular">
        <div class="popular-left">
            <h2 class="section-title">Популярные товары</h2>
            <div class="cards-row cards-row-3" id="popular-container">
        
            </div>
            <div class="show-more">
                <button id="load-more-popular">Показать больше</button>
            </div>
        </div>
        <div class="popular-right">
            <h2 class="section-title">Популярные бренды</h2>
            <div id="shops-container"></div>
        </div>
    </section>
</main>
    <script src="{{ asset('js/catalog.js') }}"></script>
    <script src="{{ asset('js/load.js') }}"></script>
<script>
    const csrfToken = '{{ csrf_token() }}';
</script>
<script>
    const isAuth = {{ auth()->check() ? 'true' : 'false' }};
</script>
@endsection