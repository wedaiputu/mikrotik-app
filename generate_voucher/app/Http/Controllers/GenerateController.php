<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function generate(Request $request)
    {
        // Validate the input data
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1',
            'uptime_limit' => 'required|integer|min:1',
        ]);

        // Check if session contains router credentials
        if (!session()->has(['ip', 'username', 'password'])) {
            return redirect()->route('login')->withErrors(['session_expired' => 'Your session has expired. Please log in again.']);
        }

        // Get router credentials from session
        $ip = session('ip');
        $user = session('username');
        $pass = session('password');

        // Initialize RouterosAPI
        $API = new RouterosAPI();
        $API->debug(false);

        if ($API->connect($ip, $user, $pass)) {
            $quantity = $request->input('quantity');
            $price = $request->input('price');
            $uptimeLimit = $request->input('uptime_limit');

            $vouchers = [];

            for ($i = 0; $i < $quantity; $i++) {
                $username = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);

                $response = $API->comm('/ip/hotspot/user/add', [
                    'name' => $username,
                    'password' => $password,
                    'profile' => 'default',
                    'limit-uptime' => "{$uptimeLimit}m",
                ]);

                if (isset($response['!trap'])) {
                    continue; // Skip failed voucher
                }

                $vouchers[] = [
                    'username' => $username,
                    'password' => $password,
                    'price' => $price,
                    'uptime_limit' => "{$uptimeLimit} minutes",
                ];
            }

            $API->disconnect();

            return response()->json([
                'success' => true,
                'message' => 'Vouchers generated successfully',
                'vouchers' => $vouchers,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to Mikrotik router',
            ]);
        }
    }
}
