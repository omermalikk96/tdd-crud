<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('welcome', compact('books'));
    }

    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'required|image|mimes:jpg,bmp,png',
            'publish_date' => 'required',
            'cost' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'is_active' => 'required',
            'stock' => 'required',
        ]);
       
         $book =  Book::create($request->all());
            return view('welcome');
        
    }

    public function show(Book $book)
    {
        return view('welcome', compact('book'));
    }


    public function edit(Book $Book)
    {
        return view('Books.edit',compact('Book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = request()->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'required|image|mimes:jpg,bmp,png',
            'publish_date' => 'required',
            'cost' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'is_active' => 'required',
            'stock' => 'required',
        ]);

        $book->update($data);
        
        return view('welcome',compact('book'));
        
    }


    public function destroy(Book $Book)
    {
        $Book->delete();
        return view('welcome');

    }
}
