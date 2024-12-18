<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SessionController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('testsession')){
            echo $request->session()->get('testsession');
        } else {
            echo 'Data not found';
        }
    }
    public function store(Request $request){
        $request->session()->put('testsession', 'This is a test session');
        echo $request->session()->get('testsession');
    }
}
