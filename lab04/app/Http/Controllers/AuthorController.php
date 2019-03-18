<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $authors = \App\Author::all();

            return view('authors.index', compact('authors'));
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
                'name' => 'required'
            ]);

            $author = \App\Author::where('name', '=', $request->name)->first();
            if (!is_null($author)) {
                \Session::flash('error', 'Author already exists');
                return redirect()->back();
            }

            $author = new \App\Author([
                'name' => $request->name
            ]);
            $author->save();

            return redirect()->back();
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
        //
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
        if (Auth::check() && Auth::user()->role == 'admin') {
            $books = \App\Book::all();
            foreach ($books as $book) {
                if ($book->author->id == $id) {
                    \App\Book::destroy($book->id);
                }
            }
            \App\Author::destroy($id);
            return redirect()->back();
        } else {
            return redirect()->intended('login');
        }
    }
}
