<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

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
        $clients = Client::select('id')->count();
        return view('home',[
            'num_clients' => $clients
        ]);
    }
}
