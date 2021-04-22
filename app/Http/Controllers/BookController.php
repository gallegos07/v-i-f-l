<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\BookFormRequest;

class BookController extends Controller
{
   
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->get();
        return Inertia::render('Book', ['books' => $books]);
    }

    public function create()
    {
        return Inertia::render('Book/Create');
    }

    public function store(BookFormRequest $request)
    {
        // $book = new Book([
        //     'title' => $request->input('title'),
        //     'author' => $request->input('author'),
        //     'isbn' => $request->input('isbn')]);
        //  $book->save();

        Book::create($request->all());

        return response()->json('Registro exitoso');

    }

    public function show($id)
    {
        //
    }

  
    public function edit(Book $book)
    {
        return Inertia::render('Book/Edit', ['book' => $book]);
    }

    public function update(BookFormRequest $request)
    {
        $book = Book::find($request->id);
        $book->update($request->all());

        // return Redirect::route('books.index', $book)->with('success', 'User created.');
        // return response()->json('Actualizado correctamente');
    }

    public function destroy(Book $book)
    {
        $book->delete();
   
        return response()->json('Eliminado correctamente');
    }
}