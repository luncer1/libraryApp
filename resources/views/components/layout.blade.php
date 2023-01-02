<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    
    <title>Library</title>
</head>
<body>
    <header>
        <div class="login-bar">
            <ul class="login-list">
                @auth
                <li class="login-element"> Witaj, {{ auth()->user()->login }}</li>
                <a href="/myrents"><li class="login-element">  <i class="fa-solid fa-gear"></i> Zarządzanie kontem</li></a>
               <li class="login-element"><form method="POST" class="inline"  action="/logout">
                @csrf
                <button type="Submit" style="background-color: transparent; border: none; color:white; margin-right:15px">
                    <i class="fa-solid fa-door-closed"></i> Wyloguj
                </button>
            </form></li>
                @else
                <a href="/register"><li class="login-element"> <i class="fa-regular fa-user"></i> Stwórz konto</li></a>
                <a href="/login"><li class="login-element">  <i class="fa-solid fa-right-to-bracket"></i> Zaloguj się</li></a>
                @endauth
            </ul>
        </div>
        <div class="logo-bar">
            <div class="logo-bar-image"></div>
        </div>
        <div class="menu-bar">
            <ul class="menu-list">
                <a href="/"><li class="menu-list-element">Przeglądaj</li></a>
                @can('add-book')
                <a href="/book/create"><li class="menu-list-element">Dodaj Nowy</li></a>
                @endcan
                @can('admin-panel')
                <a href="/admin"><li class="menu-list-element">Panel administratora</li></a>
                @endcan
                @can('all-rents')
                <a href="/allrents"><li class="menu-list-element">Wypożyczenia</li></a>
                @endcan
            </ul>
        </div>
    </header>
    <main>
        <x-flash-message />
        <x-flash-error />
        {{ $slot }}
    </main>

</body>
</html>