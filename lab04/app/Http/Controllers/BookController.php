<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $books = \App\Book::all();

            return view('books.index', compact('books'));
        } else {
            return redirect()->intended('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'name' => 'required',
                'isbn' => 'required',
                'publication_year' => 'required',
                'publisher' => 'required',
                'author_id' => 'required'
            ]);

            $book = \App\Book::where('isbn', '=', $request->isbn)->first();
            if (!is_null($book)) {
                \Session::flash('error', 'Book already exists');
                return redirect()->back();
            }

            $author = \App\Author::find($request->author_id);
            $book = new \App\Book([
                'name' => $request->name,
                'isbn' => $request->isbn,
                'publication_year' => $request->publication_year,
                'publisher' => $request->publisher,
                'image' => $request->image,
                'author' => $author
            ]);
            $book->save();
            return view('books.show', ['book' => $book]);
        } else {
            return redirect()->intended('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $book = \App\Book::find($id);
            return view('books.show', ['book' => $book]);
        } else {
            return redirect()->intended('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            \App\Book::destroy($id);
            return redirect()->intended('books');
        } else {
            return redirect()->intended('login');
        }
    }
}
