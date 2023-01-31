<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel='stylesheet' type='text/css' href='app.css'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
  <title>@yield('title', '올해의 책')</title>
</head>
<body>
  <nav class='navbar bg-dark'>
    <div class='container d-flex justify-content-end gap-3'>
      <a href={{route('home.index')}} class='text-white'>추천 목록</a>
      <a href={{route('book.create')}} class='text-white'>등록</a>
      @if(Auth::user())
        <div class='text-white'>{{ Auth::user() -> name }}</div>
        <form action='/logout'method='POST'>
          @csrf
          <button type='submit' class='btn btn-light' >로그아웃</button>
        </form>
      @else
        <button onclick='location.href = "{{ route('login') }}"' class='btn btn-light' >로그인</button>
      @endif
    </div>
  </nav> 
  <main class='container'>
    @yield('content')
  </main>
  </body>
</html>