@extends('layout')

@section('title')
  나의 책 추천
@endsection

@section('content')
  <h1>추천 책 등록</h1>
  
  <form action='/book/new' method='POST'>
    @csrf
    <label for='title'>제목</label>
    <input type='text' name='title' id='title' value='{{old('title')}}' required >
    @error('title')
      {{$message}}
    @enderror
    <label for='author'>저자</label>
    <input type='text' name='author' id='author' value='{{old('author')}}'>
    @error('author')
      {{$message}}
    @enderror
    <label for='price'>가격</label>
    <input type='text' name='price' id='price' value='{{old('price')}}' required>
    @error('price')
      {{$message}}
    @enderror
    <label for='page'>페이지</label>
    <input type='text' name='page' id='page' value='{{old('page')}}' required >
    @error('page')
      {{$message}}
    @enderror
    <button type='submit'>추천하기</button>
  </form> 
@endsection