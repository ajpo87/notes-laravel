<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function logout(){
        return view('logout');
    }

    public function loginSubmit( Request $request){
       
        //Form validation
        $request->validate(
            [
                'text_username' => 'required',
                "text_password" => 'required'
            ]
        ); 

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_paswoord');
        echo 'ok';
    }
}
