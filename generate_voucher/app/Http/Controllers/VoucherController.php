<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class VoucherController extends Controller
{
    public Function index(){
        return view('voucher');
    }
}
