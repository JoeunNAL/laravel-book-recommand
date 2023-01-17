@extends('layout')

{{--
@section('title')
@endsection
--}}

@section('content')
  <h1 class='my-4'>올해의 추천</h1>
  <table class='table table-hover'>
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
    <tbody class='table-group-divider'>
      @foreach($books as $book)
        <tr>
          <td>{{$book->id}}</td>
          <td>{{$book->title}}</td>
          <td>
            @if(!$book->author)
              -
            @else
              {{ $book->author }}
            @endif
          </td>
          <td>{{$book->page}}</td>
          <td>{{$book->price}}</td>
          <td>
            <a href='/book/{{$book->id}}/edit'>
              <button type='button' class="btn btn-light">수정</button>
            </a>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>

@endsection