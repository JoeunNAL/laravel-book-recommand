<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <span class="navbar-brand">올해의 책</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-md-auto text-center min-width-150">
      <li class="nav-item mx-3 row min-width-150">
        <a class="nav-link col-lg-8 col-12 {{ request()->path() === "/" ? 'active' : '' }}" href={{route("home.index")}}>
        추천 목록
        </a>
        <a class="nav-link col-lg-4 col-12 {{ request()->path() === "book/create" ? 'active' : '' }}" href={{route("book.create")}}>
        등록
        </a>
      </li>
      @if(Auth::user())
      <li class="nav-item mx-3 mt-3 my-auto mb-2 mb-md-0">
        <div class="text-info mb-2">{{ Auth::user() -> name }} 님</div>
      </li>
      <li class="nav-item mx-lg-1 mb-2 mb-lg-0">
        <form action="/logout"method="POST">
          @csrf
          <button type="submit" class="btn btn-light">로그아웃</button>
        </form>
      </li>
      @else
      <li class="nav-item mb-2 mb-lg-0">
        <button class="btn btn-light" onclick="location.href = '{{ route("login") }}'">로그인</button>
      </li>
      @endif
    </ul>
  </div>
</nav>