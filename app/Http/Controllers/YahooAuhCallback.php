<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YahooAuthCallback extends Controller
{
    public function handleCallback(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return response()->json(['success' => false, 'message' => 'No authorization code provided.']);
        }

        // Your Yahoo API credentials
        $clientId = env('YAHOO_CLIENT_ID');
        $clientSecret = env('YAHOO_CLIENT_SECRET');
        $redirectUri = env('YAHOO_REDIRECT_URI');

        // Step to exchange the authorization code for an access token
        $response = Http::asForm()->post('https://api.login.yahoo.com/oauth2/get_token', [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $redirectUri,
            'code' => $code,
            'grant_type' => 'authorization_code',
        ]);

        if ($response->successful()) {
            $tokenData = $response->json();
            // You can now use the access token and fetch user info
            return response()->json(['success' => true, 'token_data' => $tokenData]);
        } else {
            // Return the actual error message from the response
            $errorMessage = $response->json('error_description', 'Failed to exchange code for token.');
            return response()->json(['success' => false, 'message' => $errorMessage]);
        }
    }
}
