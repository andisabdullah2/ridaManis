<?php
// app/Http/Controllers/GoogleController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->addScope(\Google_Service_PeopleService::CONTACTS);
        $client->setRedirectUri(route('google.callback'));
        $client->setAccessType('offline');
        $client->setPrompt('consent'); // agar refresh_token diberikan

        return redirect($client->createAuthUrl());
    }

    public function handleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setRedirectUri(route('google.callback'));

        $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
        session(['google_token' => $token]); // simpan token

        return redirect()->route('pax.create')->with('success', 'Login Google berhasil.');
    }
}
