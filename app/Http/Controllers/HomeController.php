<?php

namespace App\Http\Controllers;

use App\Bid;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('confirm_email');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome', ['high_bid' => Bid::getHighBid()]);
    }

    public function confirm_email($userid)
    {
        if ($user = User::find($userid)) {
            $user->confirmed = true;
            $user->save();

            Auth::login($user);

            return redirect('/')->with('status', 'Your email address has been confirmed');
        }
    }

    public function placeBid(Request $request)
    {
        $bid = (int) $request->bid;

        if ($bid > (Bid::getHighBid() + config('bids.increment'))) {
            Bid::create(['bid' => $bid, 'bidder' => Auth::user()->id]);

            return redirect('/')->with('status', 'Your bid has been placed');
        }

        return redirect('/')->with('error', 'Your bid is not high enough');

    }
}
