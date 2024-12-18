<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        session()->put('name', 'oqbweowqe');
        return view('index');
    }
}
