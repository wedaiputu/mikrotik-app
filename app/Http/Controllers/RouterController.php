<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \RouterOS\Client;
use \RouterOS\Query;

class RouterController extends Controller
{
    public function index()
    {
        return view('router.index'); // Load the form view
    }

    public function connect(Request $request)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'host' => 'required|ip',
            'user' => 'required|string',
            'pass' => 'required|string',
            'port' => 'required|integer',
        ]);

        try {
            // Initiate client with dynamic values from the form
            $client = new Client([
                'host' => $validated['host'],
                'user' => $validated['user'],
                'pass' => $validated['pass'],
                'port' => (int)$validated['port'],
            ]);

            // Create "where" Query object for RouterOS
            $query = (new Query('/ip/hotspot/ip-binding/print'))->where('mac-address', '00:00:00:00:40:29');

            // Send query and read response from RouterOS
            $response = $client->query($query)->read();

            // Return the response to the view
            return view('router.response', compact('response'));

        } catch (\Exception $e) {
            // Handle connection errors
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
