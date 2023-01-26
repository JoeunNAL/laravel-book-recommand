@extends('layout')

@section('title')
  나의 책 추천
@endsection

@section('content')
  <h1 class='my-5'>추천 책 등록</h1>
  <form action='/book' method='POST' class='was-validated' novalidate>
    @csrf
    <div class='form-group mb-2'>
      <label for='title' class='form-label'>제목</label>
      <input type='text' class='form-control' name='title' id='title' value='{{ old('title') }}' required >
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class='form-group mb-2'>
      <label for='author' class='form-label'>저자</label>
      <input type='text' class='form-control' name='author' id='author' value='{{ old('author') }}' placeholder='저자를 입력하지 않으면 - 로 표시됩니다.' >
    </div>
    <div class='form-group mb-2'>
      <label for='price' class='form-label'>가격</label>
      <input type='number' class='form-control' name='price' id='price' value='{{ old('price') }}' placeholder='숫자를 입력해주세요.' required >
      @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class='form-group mb-2'>
      <label for='page' class='form-label'>페이지</label>
      <input type='number' class='form-control' min='1' name='page' id='page' value='{{ old('page') }}' placeholder='숫자를 입력해주세요.' required >
      @error('page')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div>
      <label for="category">카테고리</label>
      <select name="category" id="category" class="form-select mb-2">
        @foreach ($categories as $category)
          <option value='{{$category}}'>{{ $category }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label for="brand">브랜드</label>
      <select name="brand" id="brand" class="form-select mb-2">
        @foreach ($brands as $brand)
          <option value="{{ $brand -> id }}">{{ $brand -> brand_name }}</option>
        @endforeach
      </select>
    </div>
    <button type='submit' class='btn btn-dark mt-4'>추천하기</button>
  </form> 
@endsection