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
            // Generate random credentials for the voucher
            $username = 'user_' . rand(1000, 9999); // Example: user_1234
            $password = rand(10000, 99999);        // Example: 12345

            // Add the user to the Hotspot system
            $response = $API->comm('/ip/hotspot/user/add', [
                'name' => $username,
                'password' => $password,
                'profile' => 'default', // Ensure you have a valid profile set up
            ]);

            // Disconnect from the API
            $API->disconnect();

            if (isset($response['!trap'])) {
                // Error handling
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create voucher',
                    'error' => $response['!trap']
                ]);
            }

            // Successfully created
            return response()->json([
                'success' => true,
                'message' => 'Voucher generated successfully',
                'voucher' => [
                    'username' => $username,
                    'password' => $password,
                ]
            ]);
        } else {
            // Connection failed
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to MikroTik router',
            ]);
        }
    }
}
