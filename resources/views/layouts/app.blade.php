<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ruangbelanja.')</title>
    
    <!-- Ini yang menghubungkan file eksternal css.txt (store.css) kamu ke tampilan web -->
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body>
<nav>
    <div class="container nav">
        <a class="brand" href="{{ route('shop.index') }}">ruangbelanja.</a>
        <a href="{{ route('shop.index') }}">Produk</a>
        
        @auth
            @if(auth()->user()->role === 'customer')
                <a href="{{ route('cart.index') }}">Keranjang</a>
                <a href="{{ route('orders.index') }}">Pesanan</a>
            @else
                <a href="{{ route('admin.dashboard') }}">Admin</a>
            @endif
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-light" type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Masuk</a>
            <a href="{{ route('register') }}">Daftar</a>
        @endauth
    </div>
</nav>
<main>
    <div class="container">
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @yield('content')
    </div>
</main>
</body>
</html>