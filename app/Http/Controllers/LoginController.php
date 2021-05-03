<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    
    public function login(Request $request){

        $name = $request->input('name');
        $password = $request->input('password');
        $data = User::getUser($name, $password);
        $count = count($data);
        $request->session()->put('password', $password);
    
        if ($count == 1){
            $request->session()->put('name', $name);

        if ($name != 'root') {
            $name = 'user';
        }
            return redirect("/lobby/{$name}");
        } else {
            return redirect("/")
            ->with('error','登入失敗');
        }
    }
    
    public function logout(Request $request){
        $request->session()->forget('name');
        return redirect("/");
    }
}
