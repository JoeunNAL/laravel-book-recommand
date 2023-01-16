<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class HomeController extends Controller
{
    public function index() {
        $books = Book::get();

        return view('index', ['books' => $books]);
    }

    public function create() {
        return view('form');
    }

    public function store(Request $request){
        // 유효성 검사
        $request -> validate([
            'title' => 'required',
            'price' => 'required',
            'page' => 'required',
        ]);
        
        $title = $request -> input('title');
        $author = $request -> input('author');
        $price = $request -> input('price');
        $page = $request -> input('page');
        
        Book::create([
            "title" => $title,
            "author" => $author,
            "price" => $price,
            "page" => $page,
        ]);

        return redirect() -> route('home.index');
    }

    public function edit(Book $book) {
        return view('edit',['book' => $book]);
    }

    public function update(Book $book, Request $request) {
        // 유효성 검사
        $request -> validate([
            'title' => 'required',
            'price' => 'required',
            'page' => 'required',
        ]);

        $book-> title = request('title');
        $book-> author = request('author');
        $book-> price = request('price');
        $book-> page = request('page');

        $book-> save();

        return redirect() -> route('home.index');
    }

    public function destroy(Book $book) {
        $book-> delete();

        return redirect() -> route('home.index');
    }
}


