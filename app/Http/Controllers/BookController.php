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
        
        // return redirect()->route('Books.index')->with('success','Created Successfully.');
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
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
        ]);

        $Book->update($data);
        return redirect()->route('Books.index')->with('success','Updated Successfully.');
    }


    public function destroy(Book $Book)
    {
        $Book->delete();
        // return redirect()->route('Books.index')->with('success','Student deleted successfully.');
    }
}