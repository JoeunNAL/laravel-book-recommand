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
        $categories = Category::get();
        
        // 카테고리 중복 요소 제거
        $category_names = array();
        foreach($categories as $category){
            if(!in_array($category->name, $category_names)){
                array_push($category_names, $category->name);
            };
        };
        
        // 현재 로그인한 유저의 로그 기록 : 수정버튼 표기용 
        $user_recommends = ModificationLog::where('user_id', Auth::id())-> get();

        return view('index', ['books' => $books, 'user_recommends' => $user_recommends, 'brands' => $brands, 'category_names' => $category_names]);
    }

    public function search() {
        $books = collect();
        // $books = array();
        $target_categories = array();

        if (request('selected_category') && request('selected_brand')) {
            $target_categories = Category::where('name', request('selected_category')) -> where('brand_id',request('selected_brand')) -> get();
        } else if (request('selected_category') || request('selected_brand')) {
            $target_categories = Category::where('name', request('selected_category')) -> orWhere('brand_id',request('selected_brand')) -> get();
        };
        
        foreach ($target_categories as $target_category) {
            $target_category_books = $target_category -> books() -> get();
            $books = $books -> concat($target_category_books);
            // $target_category_books = $target_category -> books() -> get() -> all();
            // $books = array_merge($books, $target_category_books);
        };


        $brands = Brand::get();
        $categories = Category::get();
        
        // 카테고리 중복 요소 제거
        $category_names = array();
        foreach ($categories as $category){
            if(!in_array($category->name, $category_names)){
                array_push($category_names, $category->name);
            };
        };

        // 현재 로그인한 유저의 로그 기록 : 수정버튼 표기용 
        $user_recommends = ModificationLog::where('user_id', Auth::id())-> get();
        foreach($target_categories as $target){
            if(!in_array($category->name, $category_names)){
            array_push($books);
            };
        }

        return view('index', ['books' => $books , 'user_recommends' => $user_recommends, 'brands' => $brands, 'category_names' => $category_names]);
    }

    // public function db() {
    //     $books = Book::get();

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
    //     User::create([
    //         'name' => 'ej',
    //         'email' => 'ej@naver.com',
    //         'password' => "1234",
    //     ]);
    //     User::create([
    //         'name' => 'jj',
    //         'email' => 'jj@naver.com',
    //         'password' => "1234",
    //     ]);
    //     Book::create([
    //         'title' => 'ccor   df',
    //         'author' => "au2thoer",
    //         'price' => 13434234,
    //         'page' => 12,
    //         'category_id'=> 2, 
    //     ]);
    // }


    public function create() {
        $categories = Category::get();
        
        // 카테고리 중복 요소 제거
        $category_names = array();
        foreach($categories as $category){
            if(!in_array($category->name, $category_names)){
                array_push($category_names, $category->name);
            }
        }

        $brands = Brand::get();

        return view('form',['categories'=>$category_names, 'brands' => $brands]);
    }

    public function store(FormDataRequest $request){
        $title = request('title');
        $author = request('author');
        $price = request('price');
        $page = request('page');

        $brand_id = request('brand');
        $category_name = request('category');
        $category_id = Category::where('name', $category_name)->where('brand_id',$brand_id)->get()-> first() -> id;

        Book::create([
            'title' => $title,
            'author' => $author,
            'price' => $price,
            'page' => $page,
            'category_id' =>$category_id
        ]);

        // 로그 기록
        $new_book_id = Book::latest()->first()->id;

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

        // 카테고리 중복 요소 제거
        $categories = Category::get();
        $category_names = array();
        foreach ($categories as $category) {
            if(!in_array($category->name,$category_names)){
                array_push($category_names,$category->name);
            }
        }

        return view('edit',['book' => $target_book, 'category_names'=>$category_names, 'brands' => $brands]);
    }

    public function update($book_id, FormDataRequest $request) {
        $update_book = Book::where('id', $book_id) -> first();
        
        $update_book -> title = request('title');
        $update_book -> author = request('author');
        $update_book -> price = request('price');
        $update_book -> page = request('page');
        $update_book -> category_id = Category::where('name', request('category')) -> where('brand_id', request('brand')) -> first() -> id;
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
        $logs = ModificationLog::where('book_id',$book_id)-> orderByDesc('id')->get();
        
        // - book 해당상품의 수정로그 조회 버튼클릭 -> 모달창 order by id desc
        return view('log', ['logs' => $logs]);
    }

    public function getCategoryList() {
        $categories = Category::get();
        
        // 카테고리 중복 요소 제거
        $category_names = array();
        foreach($categories as $category){
            if(!in_array($category->name, $category_names)){
                array_push($category_names, $category->name);
            }
        }
        return $category_names;
    }
}


