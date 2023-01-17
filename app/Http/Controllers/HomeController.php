<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\FormDataRequest;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $books = Book::get();

        return view('index', ['books' => $books]);
    }

    public function create() {
        return view('form');
    }

    public function store(FormDataRequest $request){
        $title = request('title');
        $author = request('author');
        $price = request('price');
        $page = request('page');
        
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

    public function update(Book $book, FormDataRequest $request) {
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


