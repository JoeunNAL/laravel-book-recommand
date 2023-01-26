@extends('layout')

@section('content')
  <h1 class='my-5'>회원 가입</h1>
  <form action='/signup' method='POST' class=''>
    @csrf
    <div class='form-group mb-2'>
      <label for='name' class='form-label'>name</label>
      <input type='name' class='form-control @error('name') is-invalid @enderror' name='name' id='name' required >
    </div>
    <div class='form-group mb-2'>
      <label for='email' class='form-label'>email</label>
      <input type='email' class='form-control @error('email') is-invalid @enderror' name='email' id='email' required >
      @error('email')
        <div>{{ $message }}</div>
      @enderror
    </div>
    <div class='form-group mb-2'>
      <label for='password' class='form-label'>password</label>
      <input type='password' class='form-control @error('password') is-invalid @enderror' name='password' id='password' required >
      @error('password')
        <div>{{ $message }}</div>
      @enderror
    </div>
    <div class='form-group mb-2'>
      <label for='password_confirmation' class='form-label'>confirm password</label>
      <input type='password' class='form-control @error('password_confirmation') is-invalid @enderror' name='password_confirmation' id='password_confirmation' required >
      @error('password_confirmation')
        <div>{{ $message }}</div>
      @enderror
    </div>
    <button type='submit' class='btn btn-dark mt-4'>회원가입</button>
  </form> 
  <div class='mt-4'>
  </div>
@endsection
