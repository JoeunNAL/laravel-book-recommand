<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">올해의 책</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active ">
        <a class="nav-link" href={{route("home.index")}}>추천 목록</a>
        <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href={{route("book.create")}}>등록</a>
      </li>
      @if(Auth::user())
      <li class="nav-item">
        <div class="text-white">{{ Auth::user() -> name }}</div>
      </li>
      <li class="nav-item">
        <form action="/logout"method="POST">
          @csrf
          <button type="submit" class="btn btn-light">로그아웃</button>
        </form>
      </li>
      @else
      <li class="nav-item">
        <button class="btn btn-light" onclick="location.href = '{{ route("login") }}'">로그인</button>
      </li>
      @endif
    </ul>
  </div>
</nav>