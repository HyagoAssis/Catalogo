<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>Chico Rei</title>

</head>

<body>
    <div id="app">
        <div class="top-header"></div>

        <header class="header">
            <img src="{{asset('img/logo.png')}}" alt="">
            <div class=header-container>
                <div class="header-item">
                    <img src="{{asset('img/person-outline.svg')}}" alt="">
                    <p>Entre ou cadastra-se</p>
                </div>
                <div class="header-item">
                    <img src="{{asset('img/bag-outline.svg')}}" alt="">
                    <p>Sacola</p>
                </div>
            </div>
        </header>
        <main>
            <ProductList />
        </main>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>