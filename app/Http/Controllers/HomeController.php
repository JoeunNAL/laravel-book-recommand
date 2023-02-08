<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ModificationLog;
use App\Models\User;
use App\Http\Requests\FormDataRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $books = Book::get();
        $brands = Brand::get();
        $categories = Category::distinct() -> get('name');

        // 수정버튼 표기용 : 로그인한 사용자의 작성 목록
        $user_recommends = ModificationLog::where('user_id', Auth::id()) -> get();

        return view('index', ['books' => $books, 'user_recommends' => $user_recommends, 'brands' => $brands, 'categories' => $categories]);
    }

    public function search() {
        $books = Book::get();
        $brands = Brand::get();
        $categories = Category::distinct() -> get('name');

        // 수정버튼 표기용 : 로그인한 사용자의 작성 목록
        $user_recommends = ModificationLog::where('user_id', Auth::id())-> get();

        // 카테고리, 브랜드 둘 중에 하나라도 선택된 경우, books 목록 취합
        if(request('selected_category') || request('selected_brand')){
            if (request('selected_category') && request('selected_brand')) {
                $books = Category::getBothSatisfy('name', 'selected_category', 'brand_id', 'selected_brand') -> first() -> books() -> get();
            
            } else {
                // 하나만 선택했을 경우 여러 카테고리 id 선별
                $target_categories = Category::getEitherSatisfy('name', 'selected_category', 'brand_id', 'selected_brand') -> get();

                $books = array();
                foreach ($target_categories as $target_category) {
                    $target_category_books = $target_category -> books() -> get() -> all();
                    $books = array_merge($books, $target_category_books);
                };
            };
        };

        return view('index', ['books' => $books , 'user_recommends' => $user_recommends, 'brands' => $brands, 'categories' => $categories]);
    }

    public function create() {
        $categories = Category::distinct() -> get('name');
        $brands = Brand::get();

        return view('form',['categories' => $categories, 'brands' => $brands]);
    }

    public function store(FormDataRequest $request){
        $title = request('title');
        $author = request('author');
        $price = request('price');
        $page = request('page');

        $category_id = Category::getBothSatisfy('name', 'category', 'brand_id', 'brand') -> first() -> id;

        Book::create([
            'title' => $title,
            'author' => $author,
            'price' => $price,
            'page' => $page,
            'category_id' => $category_id
        ]);

        // 로그 기록
        $new_book_id = Book::latest() -> first() -> id;

        ModificationLog::create([
            'user_id' => Auth::id(),
            // 'user_id' => Auth::user() -> id,
            'book_id' => $new_book_id,
            'history' => '등록 : '.$title
        ]);

        return redirect() -> route('home.index');
    }

    public function edit($book_id) {
        // 다른 사용자의 접근 제어
        $book_user_id = ModificationLog::where('book_id', $book_id) -> first() -> user_id;
        abort_if(Auth::id()!==$book_user_id, 403);

        $target_book = Book::where('id', $book_id) -> first();
        $brands = Brand::get();
        $categories = Category::distinct() -> get('name');

        return view('edit',['book' => $target_book, 'categories' => $categories, 'brands' => $brands]);
    }

    public function update($book_id, FormDataRequest $request) {
        $update_book = Book::where('id', $book_id) -> first();
        
        $update_book -> title = request('title');
        $update_book -> author = request('author');
        $update_book -> price = request('price');
        $update_book -> page = request('page');
        $update_book -> category_id = Category::getBothSatisfy('name', 'category', 'brand_id', 'brand') -> first() -> id;

        $update_book -> save();

        ModificationLog::create([
            'user_id' => Auth::id(),
            'book_id' => $update_book -> id,
            'history' => '수정 : '.$update_book -> title
        ]);

        return redirect() -> route('home.index');
    }

    public function destroy($book_id) {
        $delete_book = Book::where('id', $book_id) -> first();
        $delete_book -> delete();

        ModificationLog::create([
            'user_id' => 1,
            'book_id' => $delete_book -> id,
            'history' => '제거 : '.$delete_book -> title
        ]);

        return redirect() -> route('home.index');
    }

    public function findLog($book_id) {
        $logs = ModificationLog::where('book_id',$book_id) -> orderByDesc('id') -> get();
        
        return response() -> json(['logs' => $logs]);
    }

    // DB 카테고리, 브랜드 목록 생성 
    // public function db() {
    //     Category::create([
    //         'name' => '소설',
    //         'brand_id' => 1,
    //     ]);
    //     Category::create([
    //         'name' => '역사',
    //         'brand_id' => 1,
    //     ]);
    //     Category::create([
    //         'name' => '소설',
    //         'brand_id' => 2,
    //     ]);
    //     Category::create([
    //         'name' => '역사',
    //         'brand_id' => 2,
    //     ]);
    //     Brand::create([
    //         'brand_name' => '꿈',
    //     ]);
    //     Brand::create([
    //         'brand_name' => 'Rna',
    //     ]);
    // }
}


