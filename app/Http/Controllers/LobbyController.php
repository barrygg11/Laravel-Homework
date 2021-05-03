<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Game;
use App\Models\GameConfig;

class LobbyController extends Controller
{
    public function index(Request $request){
        $user = $request->session()->get('name');
        $getOverage = User::getOverage($user);
        $overage = $getOverage[0]['overage'];
        
        $getOpenGame = Game::getOpenGame();
        if($user == "root"){
            return view('adminLobby');
        }else{
        return view('lobby',['overage'=>$overage],['getOpenGame'=>$getOpenGame]);
        }
    }

    //顯示所有帳號
    public function AdminAccountManagement(){
        $adminAccountManagement =User::AdminAccountManagement();
        foreach($adminAccountManagement as $name){
            echo $name['name'];
        }
        // print_r($adminAccountManagement);
        return view('adminAccountManagement',['adminAccountManagement'=>$adminAccountManagement]);
    }

    //刪除帳號
    public function AdminDeleteAccount($user_id){
        User::AdminDeleteAccount($user_id);
        return redirect("/admin/AccountManagement")
        ->with('success',"刪除成功");
    }

    public function show(Request $request){
        $user = $request->session()->get('user');
        $status = $request->session()->get('status');
        $time = $request->session()->get('time');
        $take = $request->session()->get('take');
        $getUserData =Bank::getUserData($user, $status, $time, $take);
        return view('adminGetAllUserData',['allUserData'=>$getUserData]);
        }
    //顯示所有使用者存提款資料
    public function getAllUserData(Request $request){
        $user = $request->input('user');
        $status = $request->input('status');
        $time = $request->input('time');
        $take = $request->input('take');
        $request->session()->put('user', $user);
        $request->session()->put('status', $status);
        $request->session()->put('time', $time);
        $request->session()->put('take', $take);
        return redirect("/admin/getAllUserData");
    }
}
