@extends('layout')

@section('content')
  <h1>책 정보 수정</h1>
  <form action='/book/{{$book->id}}' method='POST'>
      @method('PUT')
      @csrf
      <label for='title'>제목</label>
      <input type='text' name='title' id='title' value='{{old('title')? old('title') : $book->title}}' >
      @error('title')
      {{$message}}
      @enderror
      <label for='author'>저자</label>
      <input type='text' name='author' id='author' value='{{old('author')? old('author') : $book->author}}' >

    <label for='price'>가격</label>
      <input type='text' name='price' id='price' value='{{old('price')? old('price') : $book->price}}' >
      @error('price')
      {{$message}}
      @enderror
    <label for='page'>페이지</label>
      <input type='text' name='page' id='page' value='{{old('page')? old('page') : $book->page}}' >
      @error('page')
      {{$message}}
      @enderror
      <button type='submit'>수정</button>
  </form> 
  <form action='/book/{{$book->id}}' method='POST'>
      @method('DELETE')
      @csrf
      <button type='submit'>제거</button>
  </form>
@endsection