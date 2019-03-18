<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $subscriptions = \App\Subscription::all();

            return view('subscriptions.index', compact('subscriptions'));
        } else {
            return redirect()->intended('login');
        }
    }

    public function create(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'email' => 'required',
                'isbn' => 'required'
            ]);

            $user = \App\User::where('email', '=', $request->email)->first();
            $book = \App\Book::where('isbn', '=', $request->isbn)->first();

            if (is_null($user)) {
                \Session::flash('error', 'No user found matching email');
                return redirect()->back();
            }

            if (is_null($book)) {
                \Session::flash('error', 'No book found matching ISBN');
                return redirect()->back();
            }

            $book->subscription_status = true;
            $book->save();

            $subscription = new \App\Subscription([
                'user_id' => $user->id,
                'book_id' => $book->id
            ]);
            $subscription->save();
            \Session::flash('message', 'Subscription Successful');
            return redirect()->back();
        } else {
            return redirect()->intended('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'subscriber' || Auth::user()->role == 'admin')) {
            $request->validate([
            'book_id' => 'required'
            ]);
            $book = \App\Book::find($request->book_id);
            $existingSubscription = null;
            foreach (Auth::user()->subscriptions as $subscription) {
                if ($subscription->book_id == $book->id) {
                    $existingSubscription = $subscription;
                }
            }

            if (is_null($existingSubscription)) {
                $book->subscription_status = true;
                $book->save();

                $subscription = new \App\Subscription([
                    'user_id' => Auth::id(),
                    'book_id' => $book->id
                ]);
                $subscription->save();
                \Session::flash('message', 'Subscription Successful');
                return redirect()->intended('books');
            } else {
                \Session::flash('error', 'You are already subscribed to this book');
                return redirect()->intended('books');
            }
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
    public function destroy_by_book_id($book_id)
    {
        if (Auth::check() && (Auth::user()->role == 'subscriber' || Auth::user()->role == 'admin')) {
            $subscriptionToDelete = null;
            $book = \App\Book::find($book_id);
            foreach (Auth::user()->subscriptions as $subscription) {
                if ($subscription->book_id == $book->id)
                {
                    $subscriptionToDelete = $subscription;
                }
            }

            if (is_null($subscriptionToDelete)) {
                \Session::flash('error', 'Unsubscription Unsuccessful');
                return redirect()->intended('books');
            } else {
                \App\Subscription::destroy($subscriptionToDelete->id);

                if (!$book->hasSubscription()) {
                    $book->subscription_status = false;
                    $book->save();
                }

                \Session::flash('message', 'Unsubscription Successful');
                return redirect()->intended('books');
            }
        } else {
            return redirect()->intended('login');
        }
    }

    public function destroy($id)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $subscription = \App\Subscription::find($id);
            $book = $subscription->book;

            \App\Subscription::destroy($id);
            if (!$book->hasSubscription()) {
                $book->subscription_status = false;
                $book->save();
            }

            \Session::flash('message', 'Subscription Deleted');
            return redirect()->intended('subscriptions');
        } else {
            return redirect()->intended('login');
        }
    }
}
