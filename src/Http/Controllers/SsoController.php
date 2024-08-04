<?php

namespace Sso\SsoSdk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Sso\SsoSdk\Providers\SsoUserProvider;

class SsoController extends Controller
{
    public function redirectLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }
        $token = $request->token;
        if (!$token) {
            throw new \RuntimeException('Token is missing');
        }

        $response = Http::baseUrl(config('sso.url'))
            ->acceptJson()
            ->withToken($token)
            ->withHeader('partnership', config('sso.partnership'))
            ->get('api/user/access-token');

        if ($response->status() !== 200) {
            throw new \RuntimeException('Unauthorized');
        }
        $data = $response->json();
        $userModel = config('sso.user_model');
        $user = new $userModel();
        $user->fill($data['user']);

        $request->session()->put(SsOUserProvider::SESSION_USER, $user);
        $request->session()->put(SSOUserProvider::SESSION_TOKEN, $data['access_token']);
        $request->session()->put(SSOUserProvider::SESSION_SCOPES, $data['scopes']);

        Auth::login($user);

        return redirect('/');
    }

    public function auth(Request $request)
    {
        $token = $request->token;
        if (!$token) {
            throw new \RuntimeException('Token is missing');
        }

        $response = Http::baseUrl(config('sso.url'))
            ->acceptJson()
            ->withToken($token)
            ->withHeader('partnership', config('sso.partnership'))
            ->get('api/user/auth');

        if ($response->status() !== 200) {
            throw new \RuntimeException('Unauthorized', $response->status());
        }

        return $response->json();
    }
}
