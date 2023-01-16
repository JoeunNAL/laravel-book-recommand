@extends('layout')

{{--
@section('title')
@endsection
--}}

@section('content')
  <h1>올해의 추천</h1>
  <table>
    <thead>
      <tr>
        <td>No.</td>
        <td>제목</td>
        <td>저자</td>
        <td>페이지</td>
        <td>가격</td>
        <td>수정</td>
      </tr>
    </thead>
    <tbody>
      @foreach($books as $book)
        <tr>
          <td>{{$book->id}}</td>
          <td>{{$book->title}}</td>
          <td>{{$book->author}}</td>
          <td>{{$book->page}}</td>
          <td>{{$book->price}}</td>
          <td><a href='/book/{{$book->id}}/edit' >수정</a></td>
        </tr>
      @endforeach

    </tbody>
  </table>

@endsection