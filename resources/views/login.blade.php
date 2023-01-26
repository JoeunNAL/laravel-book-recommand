@extends('layout')

@section('content')
  <h1 class='my-5'>로그인</h1>
  <form action='/login' method='POST' class='form-group'>
    @csrf
    <div class='form-group mb-2'>
      <label for='email' class='form-label'>email</label>
      <input type='email' class='form-control @error('email') is-invalid @enderror' name='email' id='email' value='{{ old('email') }}' required >
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
    <!-- 로그인 실패 메세지 -->
    @if ( session('error') )
      <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif
    <button type='submit' class='btn btn-dark mt-4'>로그인</button>
  </form> 
  <div class='mt-4'>
    <p>회원이 아니라면? <a href={{ route('signup') }}>회원가입</a></p>
  </div>
@endsection