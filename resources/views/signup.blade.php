@extends('layout')

@section('content')
  <h1 class='my-5'>회원 가입</h1>
  <form action='/signup' method='POST' class=''>
    @csrf
    <section class='form-group mb-2'>
      <label for='name' class='form-label'>name</label>
      <input type='name' class='form-control @error('name') is-invalid @enderror' name='name' id='name' required >
    </section>
    <section class='form-group mb-2'>
      <div>
        <label for='email' class='form-label'>email</label>
        <input type='email' class='form-control @error('email') is-invalid @enderror' name='email' id='email' required >
        @error('email')
          <div class='invalid-feedback'>{{ $message }}</div>
        @enderror
        <div id='email-duplicate-check-container' class='d-flex mt-2 align-items-center'>
          <button id='email-check-btn' type='button' class='btn btn-outline-secondary'>중복 체크</button>
          <div id='match-email-result' class='text-danger-emphasis fs-6 ms-3'></div>
        </div>
      </div>
    </section>
    <section class='form-group mb-2'>
      <label for='password' class='form-label'>password</label>
      <input type='password' class='form-control @error('password') is-invalid @enderror' name='password' id='password' required >
      <div id='match-password-result' class='text-danger-emphasis fs-6 mt-2'></div>
      @error('password')
        <div class='invalid-feedback'>{{ $message }}</div>
      @enderror
    </section>
    <section class='form-group mb-2'>
      <label for='password_confirmation' class='form-label'>confirm password</label>
      <input type='password' class='form-control @error('password_confirmation') is-invalid @enderror' name='password_confirmation' id='password_confirmation' required >
    </section>
    <button type='submit' class='btn btn-dark mt-4'>회원가입</button>
  </form> 
  <div class='mt-4'>
  </div>
  <script src='assets/bootstrapValidation.js'></script>
  <script src='assets/passwordConfirm.js'></script>
  <script src='assets/emailConfirm.js'></script>
@endsection
