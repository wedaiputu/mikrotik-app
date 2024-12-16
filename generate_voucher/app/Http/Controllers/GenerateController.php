<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function generate(Request $request){
        $ip = '192.168.30.1';
        $user = 'test';
        $pass = 'test';
        $API = new RouterosAPI();
        $API->debug(false);

        if ($API->connect($ip, $user, $pass)) {
            
            $username = 'user_' . rand(1000, 9999); 
            $password = rand(10000, 99999);        

            
            $response = $API->comm('/ip/hotspot/user/add', [
                'name' => $username,
                'password' => $password,
                'profile' => 'default', 
            ]);

            
            $API->disconnect();

            if (isset($response['!trap'])) {
                
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create voucher',
                    'error' => $response['!trap']
                ]);
            }

            //berhasil
            return response()->json([
                'success' => true,
                'message' => 'Voucher generated successfully',
                'voucher' => [
                    'username' => $username,
                    'password' => $password,
                ]
            ]);
        } else {
            //failed
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to MikroTik router',
            ]);
        }
    }
}
