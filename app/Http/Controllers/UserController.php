<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    //show form for register
    public function register(){
        return view('users.register');
    }

    //store new user
    public function store(Request $request){
        $formFields = $request->validate([
            'login' => ['required','min:5',Rule::unique('users','login')],
            'password' => ['required', 'confirmed', 'min:6'],
            'birth_date' => ['required','before:today'],
            'email' => ['required','email', Rule::unique('users','email')]
        ]);
        
        $formFields['password'] = bcrypt($formFields['password']);
        $login = $formFields['login'];
        $user = User::create($formFields);
        DB::table('users')->whereRaw("login like '$login'")->update(array(

            'created_by'=>DB::table('users')->whereRaw("login like '$login'")->value("id_user"),
            'modified_by'=>DB::table('users')->whereRaw("login like '$login'")->value("id_user")
        ));
        $user -> assignRole("Klient");
        auth()->login($user);

        return redirect('/')->with('message', 'Utworzono użytkownika i zalogowano!');
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/')->with('message', 'Wylogowano!');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Zalogowano!');
        }
        return back()->withErrors(['login' => 'Błędne dane logowania'])->onlyInput('login');
    }
}
