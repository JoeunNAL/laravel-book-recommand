@extends("layout")

@section("content")
  <main class="container-md">
    <h1 class="text-center text-sm-left my-5">올해의 추천</h1>
    <section class="row">
      <form action="/search" method="GET" class="col-12 col-lg-7 justify-content-between row m-0 p-0 mb-4">
        <div class="col-12 col-md-9">
          <div class="row m-0 mb-3">
            <label for="search" class="col-12 col-sm-2 col-md-3 p-0">카테고리 : </label>
            <select name="selected_category" class="col-12 col-sm-10 col-md-9 custom-select" id="search" aria-lfabel=".form-select-sm example">
                <option value="">카테고리 선택</option>
                @foreach($category_names as $category)
                <option value="{{ $category }}" {{ request() -> get("selected_category") === $category ? "selected" : null }}>
                  {{ $category }}
                </option>
                @endforeach
            </select>
          </div>
          <div class="row m-0">
              <label for="search" class="col-12 col-sm-2 col-md-3 p-0">브랜드 : </label>
              <select name="selected_brand" class="col-12 col-sm-10 col-md-9 custom-select" id="search" aria-label=".form-select-sm example">
                <option value="">브랜드 선택</option>
                @foreach($brands as $brand)
                  <option value="{{ $brand -> id }}" 
                      {{ request() -> get("selected_brand") == ($brand->id) ? "selected" : null }}>
                      {{ $brand -> brand_name }}
                  </option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="col-12 col-md-3 my-3 my-md-0">
          <button type="submit" class="btn btn-light w-100 h-100">검색</button>
        </div>
      </form>
    </section>
    <section class="table-responsive-xl row m-0">
        <table class="table table-hover col-12">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">제목</th>
              <th scope="col">저자</th>
              <th scope="col">페이지</th>
              <th scope="col">가격</th>
              <th scope="col">카테고리</th>
              <th scope="col">브랜드</th>
              <th scope="col">수정</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="table table-hover">
            @foreach($books as $book)
              <tr>
                <td>{{$book->id}}</td>
                <td class="max-width-200">
                  <div class="ellipsis-1">{{$book->title}}</div>
                </td>
                <td class="max-width-150" scope="row">
                  <div class="ellipsis-1">
                    @if(!$book->author)
                      -
                    @else
                      {{ $book->author }}
                    @endif
                  </div>
                </td>
                <td class="max-width-80">
                  <div class="ellipsis-1">{{$book->page}}</div>
                </td>
                <td class="max-width-80">
                  <div class="ellipsis-1">{{$book->price}}</div>
                </td>
                <td class="min-width-100">{{$book->category->name}}</td>
                <td class="min-width-100">{{$book->category->brand->brand_name}}</td>
                <td>
                  @if($user_recommends -> where("book_id", $book->id) -> first())
                  <button type="button" class="btn btn-light min-width-60" 
                      onclick="location.href = '/book/{{ $book -> id }}/edit'">
                      수정
                  </button>
                  @endif 
                </td>
                <td>
                  <button type="button" class="min-width-60 text-wrap active-log-search-btn btn btn-outline-secondary" 
                    data-route="/book/{{ $book -> id }}/log" data-toggle="modal" data-target="#exampleModal">
                    로그 조회
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </section>
  </main>
  @include("modal")
@endsection