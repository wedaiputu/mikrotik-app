<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index(){

    //     $ip = '192.168.30.1';
    //     $user = 'test';
    //     $pass = 'test';
    //     $API = new RouterosAPI();
    //     $API -> debug(false);

    //     if($API->connect($ip, $user, $pass)){
    //         $identitas = $API->comm('/system/identity/print');
    //         // $router_model = $API->comm('/system/routerboard/print');
    //     } else {
    //         return 'koneksi gaagal';
    //     }
    //     // dd($router_model);
    //     // dd($identitas);

    //     $data = [
    //         'identitas' => $identitas[0]['name'],
    //         // 'router_model' => $router_model[1],
            
    //     ];
    //     // dd($data);
        return view('dashboard'); 
    }
}
