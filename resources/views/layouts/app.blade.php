<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/jpeg" href = "{{asset('images/favicon.jpg')}}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<title>@yield('title')</title>
</head>
<body>


    @include('partials.header')
    @yield('content')
    @include('partials.footer')


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>