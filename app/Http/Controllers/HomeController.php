<?php

namespace App\Http\Controllers;

use App\AssetKamar;
use App\Kamar;
use App\Keluhan;
use App\User;
use Illuminate\Http\Request;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('role_id', 3)->count();
        $rooms = Kamar::count();
        $assets = AssetKamar::sum('quantity');
        $complains = Keluhan::count();
        $myComplain = Keluhan::where('user_id', Auth::id())->count();

        $widget = [
            'users' => $users,
            'rooms' => $rooms,
            'assets' => $assets,
            'complains' => $complains,
            'myComplain' => $myComplain,
            //...
        ];

        return view('home', compact('widget'));
    }
}
