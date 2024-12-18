<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function showLoginForm()
    {
        // Display the login form
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the input data
        $request->validate([
            'ip' => 'required|ip',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Get input data
        $ip = $request->input('ip');
        $user = $request->input('username');
        $pass = $request->input('password');

        // Initialize RouterosAPI
        $API = new RouterosAPI();
        $API->debug(false);

        // Try to connect to the Mikrotik router
        if ($API->connect($ip, $user, $pass)) {
            // Fetch router identity
            $identitas = $API->comm('/system/identity/print');
            
            // Store credentials and identity in the session
            session([
                'ip' => $ip,
                'username' => $user,
                'password' => $pass,
                'router_identity' => $identitas[0]['name'] ?? 'Unknown Router',
            ]);

            // Redirect to the generate voucher page
            return redirect()->route('generate.voucher');
        } else {
            // Return an error message if the connection fails
            return redirect()->route('login')->withErrors([
                'login_failed' => 'Connection to Mikrotik failed. Please check your credentials.',
            ]);
        }
    }

    public function dashboard()
    {
        // Check if session data exists
        if (!session()->has(['ip', 'username', 'password', 'router_identity'])) {
            return redirect()->route('login')->withErrors([
                'session_expired' => 'Your session has expired. Please log in again.',
            ]);
        }

        // Pass session data to the dashboard view
        $data = [
            'router_identity' => session('router_identity'),
        ];

        return view('dashboard', $data);
    }

    public function logout()
    {
        // Clear session data
        session()->flush();

        // Redirect to login page
        return redirect()->route('login');
    }
}
