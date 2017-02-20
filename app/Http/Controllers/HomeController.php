<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth',['except'=>'index']);
        $this->middleware('admin',['only'=>'admin']);
        $this->middleware('operario',['only'=>'operario']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function admin()
    {
        return view('admin.index');
    }
    public function operario(){
        return view('operario.index');
    }
}
