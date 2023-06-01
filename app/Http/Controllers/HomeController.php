<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
       // $this->middleware('auth');
    }


    public function index()
    {   
        $user =  Auth::user();
        return view('home',[
            'assets' => $user->balances()
        ]);
    }

    public function userToken()
    {   
        //$user  = Auth::user();
       // $token =  $user->createToken("API TOKEN")->plainTextToken;  
        
    }

}