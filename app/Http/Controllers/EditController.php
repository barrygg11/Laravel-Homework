<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EditController extends Controller
{
    public function index(){
        return view('editUser');
    }

    public function edit(Request $request){
        $name = $request->session()->get('name');
        $password = $request->input('password');
        $data = User::editUser($name, $password);

        if($data == 1){

            if ($name != 'root') {
                $name = 'user';
            }
            return redirect("/edit")
            ->with('success','密碼已修改');
            }else{
            return redirect("/edit")
            ->with('error','密碼已重複');
        }
    }
}
