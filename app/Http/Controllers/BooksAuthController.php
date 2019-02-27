<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cookie;
use Crypt;

class BooksAuthController extends Controller
{
    

    public function showLoginForm()
    {
        if (Session::get('is_login') == true) {
            return redirect('/');
        } 
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        if (Session::get('is_login') == true) {
            return redirect('/');
        } 
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result = $client->post('localhost:8080/api/v1/auth/register', [
            'form_params' => [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ]
        ]);

        
        // $body = json_decode($result->getBody(), true);
        // $token = $body['access_token'];
        // echo $token;

        return redirect('/');
    }

    public function login(Request $request)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result = $client->post('localhost:8080/api/v1/auth/login', [
            'form_params' => [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], 'headers' => [
                'Accept'     => 'application/json',
            ]
        ]);
        
        $body = json_decode($result->getBody(), true);
        $token = $body['access_token'];
        Cookie::queue(Cookie::make('token_jwt', Crypt::encryptString($token), 720));
        $request->session()->put([
            'is_login' => true
            ]);

        return redirect('/admin/dashboard');
        
    }

    public function logout(Request $request)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result = $client->post('localhost:8080/api/v1/auth/logout', [
            'headers' => [
                'Accept'     => 'application/json',
                'Authorization' => 'Bearer '.Crypt::decryptString(Cookie::get('token_jwt'))
            ]
        ]);

        if($result) {
            $request->session()->flush();
            Cookie::queue(Cookie::forget('token_jwt'));
            return redirect('/');
        }
    }
}
