@extends("layout")

@section("title")
  나의 책 추천
@endsection

@section("content")
  <main class="container">
    <section class="row">
      <h1 class="col-12 col-sm-9 mx-auto my-5">추천 책 등록</h1>
      <form action="/book" method="POST" class="was-validated col-12 col-sm-9 mx-auto" novalidate>
        @csrf
        <div class="form-group mb-3">
          <label for="title" class="form-label">제목</label>
          <input type="text" class="form-control" name="title" id="title" value="{{ old("title") }}" required >
          @error("title")
          <div class="invalid-feedback ml-1">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group mb-3">
          <label for="author" class="form-label">저자</label>
          <input type="text" class="form-control" name="author" id="author" value="{{ old("author") }}" placeholder="저자를 입력하지 않으면 - 로 표시됩니다." >
        </div>
        <div class="form-group mb-3">
          <label for="price" class="form-label">가격</label>
          <input type="number" class="form-control" name="price" id="price" value="{{ old("price") }}" placeholder="숫자를 입력해주세요." required >
          @error("price")
          <div class="invalid-feedback ml-1">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group mb-3">
          <label for="page" class="form-label">페이지</label>
          <input type="number" class="form-control" min="1" name="page" id="page" value="{{ old("page") }}" placeholder="숫자를 입력해주세요." required >
          @error("page")
          <div class="invalid-feedback ml-1">{{ $message }}</div>
          @enderror
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
            <label for="category">카테고리</label>
            <select name="category" id="category" class="custom-select mb-3">
              @foreach ($categories as $category)
                <option value="{{$category -> name }}">{{ $category -> name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label for="brand">브랜드</label>
            <select name="brand" id="brand" class="custom-select mb-3">
              @foreach ($brands as $brand)
                <option value="{{ $brand -> id }}">{{ $brand -> brand_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        
        <div class="row  m-0">
          <button type="submit" class="col-12 mx-auto btn btn-dark mt-4">추천하기</button>
        </div>
      </form> 
    </section>
  </main>
@endsection