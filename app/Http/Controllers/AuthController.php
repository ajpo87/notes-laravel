<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }



    public function loginSubmit( Request $request){

        //Form validation
        $request->validate(
            // Rules
            [
                'text_username' => 'required|email',
                "text_password" => 'required|min:6|max:16'
            ],
            //Messages
            [
                'text_username.required' => 'O username é obrigatorio',
                'text_username.email' => 'O username deve ser  um email válido',
                'text_password.required'=> 'A password é obrigatoria',
                'text_password.min'=> 'A password deve ter pelo menos  :min caracters',
                'text_password.max'=> 'A password deve ter no máximo  :max caracters'
            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_paswoord');

        // check in database if user exists
        $user = User::where('username', $username)
                    ->where('deleted_at', null)
                    ->first();

         if(!$user){
            return redirect()->back()
                             ->with('loginError', 'User Or password incorretos')
                             ->withInput();
        }
       /* if(!password_verify($password, $user->password)){
            return redirect()->back()
                             ->with('loginError', 'Password incorreta')
                             ->withInput();
        }*/
        //update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //login user na session
        session([
            'user'=> [
                'id' => $user->id,
                'user_username' => $user->username
            ]
        ]);

        return redirect()->to('/');
    }

    public function logout(){
        session()->forget('user');
        return redirect()->to('login');
    }
}
