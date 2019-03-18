<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showMyUser() {
        if (Auth::check()) {
            return view('home', ['user' => Auth::user()]);
        } else {
            return redirect()->intended('login');
        }
    }

    public function index() {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $users = \App\User::all();
            return view('users.index', compact('users'));
        } else {
            return redirect()->intended('login');
        }
    }

    public function make_visitor(request $request) {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'user_id' => 'required'
            ]);

            $user = \App\User::find($request->user_id);

            if (is_null($user)) {
                \Session::flash('error', 'No user found matching id');
                return Redirect::back();
            }

            $user->role = 'visitor';
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->intended('login');
        }
    }

    public function make_subscriber(request $request) {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'user_id' => 'required'
            ]);

            $user = \App\User::find($request->user_id);

            if (is_null($user)) {
                \Session::flash('error', 'No user found matching id');
                return Redirect::back();
            }

            $user->role = 'subscriber';
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->intended('login');
        }
    }

    public function make_admin(request $request) {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'user_id' => 'required'
            ]);

            $user = \App\User::find($request->user_id);

            if (is_null($user)) {
                \Session::flash('error', 'No user found matching id');
                return Redirect::back();
            }

            $user->role = 'admin';
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->intended('login');
        }
    }
}
