<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', '올해의 책')</title>
</head>
<body>
  <header>
    <ul>
      <li><a href={{route('home.index')}}>추천 목록</a></li>
      <li><a href={{route("home.create")}}>등록</a></li>
    </ul>
    @yield('content')
  </header>  
</body>
</html>