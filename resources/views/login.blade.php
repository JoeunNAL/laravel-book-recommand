@extends("layout")

@section("content")
  <main class="container">
    <section class="row">
      <h1 class="col-12 my-5 text-center">로그인</h1>
      <form action="/login" method="POST" class="form-group col-12 col-sm-7 mx-auto">
        @csrf
        <div class="form-group mb-3">
          <label class="form-label" for="email">email</label>
          <input type="email" id="email" class="form-control @error("email") is-invalid @enderror" name="email" value="{{ old("email") }}" required >
          <!-- @error("email")
          <div>{{ $message }}</div>
          @enderror -->
        </div>
        <div class="form-group mb-3">
          <label class="form-label mb-2" for="password">password</label>
          <input type="password" id="password" class="form-control @error("password") is-invalid @enderror" name="password" required >
          @error("password")
          <div class="row m-0 invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- 로그인 실패 메세지 -->
        @if ( session("error") )
        <div class="alert alert-danger col-12" role="alert">{{ session("error") }}</div>
        @endif
        <button type="submit" class="btn btn-dark w-100 mt-4">로그인</button>
      </form> 
      <div class="mt-4 col-7 row m-0 mx-auto">
        <span class="col-md-6 col-sm-12 text-center text-md-right ">회원이 아니라면?</span>
        <a href={{ route("signup") }} class="col-md-6 col-sm-12 text-center text-md-left">회원가입</a>
      </div>
    </section>
  </main>
@endsection