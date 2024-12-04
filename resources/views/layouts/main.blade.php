<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{route('feedback')}}" class="nav-link px-2 link-body-emphasis">Feedback</a></li>
            @guest
                <li><a href="{{ route('login')}}" class="nav-link px-2 link-body-emphasis">Login</a></li>
                <li><a href="{{ route('register')}}" class="nav-link px-2 link-body-emphasis">Register</a></li>
            @endguest
        </ul>
        @auth
                <p class="col-12 col-lg-auto mt-3 mb-3 me-lg-3">Hello {{ auth()->user()->name }}</p>
                <input type="hidden" value="{{ auth()->user()->name }}" id="username">
            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="{{route('edit')}}">Edit profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <form action="{{route('logout')}}" method="post">
                    @csrf
                    <li><button class="dropdown-item" type="submit" href="#">Sign out</button ></li>
                    </form>
                </ul>
            </div>
        @endauth
      </div>
    </div>
  </header>
<div class="container-fuel">
@yield('content')
</div>
</body>
</html>