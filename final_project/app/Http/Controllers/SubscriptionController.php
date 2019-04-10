<?php

namespace App\Http\Controllers;

use App\Content;
use App\Subscription;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function create_or_activate(Request $request)
    {
        $request->validate([
            'trakt_id' => 'required'
        ]);
        if (Auth::check()) {
            $content = Content::where('trakt_id', $request->trakt_id)->first();
            $existing_subscription = Auth::user()->subscription_for_content($content);
            if (is_null($existing_subscription)) {
                $subscription = new Subscription([
                    'user_id' => Auth::user()->id,
                    'content_trakt_id' => $content->trakt_id,
                    'active' => true
                ]);
                $subscription->save();
            } else {
                $existing_subscription->active = true;
                $existing_subscription->save();
            }
            \Session::flash('message', 'Subscription Created');
            return redirect()->back();
        }
    }

    public function deactivate($id) {
        $subscription = Subscription::find($id);
		Subscription::destroy($id);
        \Session::flash('message', 'Subscription Removed');
        return redirect()->back();
    }
}
