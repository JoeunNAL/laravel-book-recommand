@extends("layout")

@section("content")
  <main class="container">
    <div class="row">
      <h1 class="my-5 col-12 text-center">회원 가입</h1>
      <form action="/signup" method="POST" class="form-group col-sm-7 mx-auto">
        @csrf
        <div class="form-group mb-3">
          <label for="name" class="form-label">name</label>
          <input type="name" class="form-control @error("name") is-invalid @enderror" name="name" id="name" required >
        </div>
        <div class="form-group mb-3">
          <div>
            <label for="email" class="form-label">email</label>
            <div class="row m-0">
              <input type='email' class="col-12 col-sm colform-control @error("email") is-invalid @enderror" name="email" id="email" required >
              <button id="email-check-btn" type="button" class="col-12 col-md-3 mt-1 m-md-0 ml-md-1 btn btn-outline-secondary">중복 체크</button>
            </div>
            <div id="email-duplicate-check-container" class="mt-2 align-items-center">
              <p id="match-email-result" class="text-danger fs-6 ms-3 pl-1"></p>
            </div>
            @error("email")
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">password</label>
          <input type="password" class="form-control @error("password") is-invalid @enderror" name="password" id="password" required >
          <div id="match-password-result" class="text-danger fs-6 mt-2 pl-1"></div>
          @error("password")
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group mb-3">
          <label for="password_confirmation" class="form-label">confirm password</label>
          <input type="password" class="form-control @error("password_confirmation") is-invalid @enderror" name="password_confirmation" id="password_confirmation" required >
        </div>
        <div class="form-group row m-0">
          <button type="submit" class="col-12 col-md-4 btn btn-dark mt-4 mx-md-auto">회원가입</button>
        </div>
      </form> 
    </div>
  </main>
  <script src="assets/bootstrapValidation.js"></script>
  <script src="assets/passwordConfirm.js"></script>
  <script src="assets/emailConfirm.js"></script>
@endsection
