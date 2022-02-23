<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        return view('welcome');
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
       
            Book::create($request->all());
            return view('welcome');
        
    }

    public function show(Book $Book)
    {
        return view('welcome');
    }


    public function edit(Book $Book)
    {
        return view('Books.edit',compact('Book'));
    }

    public function update(Request $request, Book $Book)
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

        $Book->update($data);
        return view('welcome');
        
    }


    public function destroy(Book $Book)
    {
        $Book->delete();
        return view('welcome');

    }
}
