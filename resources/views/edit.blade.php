@extends('layout')

@section('content')
  <h1 class='my-5'>책 정보 수정</h1>
  <form action='/book/{{ $book -> id }}' method='POST' class='was-validated' novalidate>
      @method('PUT')
      @csrf
      <div class='form-group mb-2'>
        <label for='title' class='form-label'>제목</label>
        <input type='text' class='form-control' name='title' id='title' value='{{ old('title')? old('title') : $book -> title }}' required >
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class='form-group mb-2'>
        <label for='author' class='form-label'>저자</label>
        <input type='text' class='form-control' name='author' id='author' value='{{ old('author')? old('author') : $book -> author }}' placeholder='저자를 입력하지 않으면 - 로 표시됩니다.' >
      </div>
      <div class='form-group mb-2'>
        <label for='price' class='form-label'>가격</label>
        <input type='number' class='form-control' name='price' id='price' value='{{ old('price')? old('price') : $book -> price }}' placeholder='숫자를 입력해주세요.' required >
        @error('price')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class='form-group mb-2'>
        <label for='page' class='form-label'>페이지</label>
        <input type='number' class='form-control' min='1' name='page' id='page' value='{{ old('page')? old('page') : $book -> page }}' placeholder='숫자를 입력해주세요.' required >
        @error('page')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div>
      <label for="category">카테고리</label>
      <select name="category" id="category" class="form-select mb-2">
        @foreach ($category_names as $category)
          <option value='{{ $category }}' 
          @if ($category === $book -> category -> name)1 
          selected
          @endif >{{ $category }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label for="brand">브랜드</label>
      <select name="brand" id="brand" class="form-select mb-2">
        @foreach ($brands as $brand)
          <option value="{{ $brand -> id }}"
          @if ( $brand -> id === $book -> category -> brand -> id)
          selected
          @endif >{{ $brand -> brand_name }}</option>
        @endforeach
      </select>
    </div>
      <button type='submit' class='btn btn-dark mt-4'>수정</button>
  </form> 
  <form action='/book/{{$book->id}}' method='POST'>
      @method('DELETE')
      @csrf
      <button type='submit' class='btn btn-outline-dark mt-4'>제거</button>
  </form>
@endsection