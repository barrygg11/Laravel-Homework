<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function index(Request $request){
        $user = $request->session()->get('name');
        $bankSum =Bank::sumGold($user);
        $sum1 = Order::sum1($user);
        $sum2 = Order::sum2($user);
        $sum = $bankSum + $sum1 - $sum2;
        User::updateOverage($user,$sum);

        $getOverage = User::getOverage($user);
        $overage = $getOverage[0]['overage'];


        $posts = Bank::selectGold($user);
        return view('accountInfo',['posts'=>$posts],['overage'=>$overage]);
    }

    public function gold(Request $request){
        $user = $request->session()->get('name');
        $gold = $request->input('gold');
        $status = $request->input('status');
        $password = $request->input('password');

        $bankSum =Bank::sumGold($user);
        $sum1 = Order::sum1($user);
        $sum2 = Order::sum2($user);
        $sum = $bankSum + $sum1 - $sum2;

        // $sum = Bank::sumGold($user);
        $userInfo = User::getUser($user, $password);
        $count = count($userInfo);

        if ($count == 1){
            if ($status == "output"){
                $gold = -$gold;
            }
            if($gold == 0){
                return redirect("/account")
                ->with('error',"請輸入金額");
            }
            if ($sum+$gold < 0){
                return redirect("/account")
                ->with('error',"餘額不足");
            }
            Bank::insertGold($user, $gold, $status);
            return redirect("/account")
            ->with('success',"成功");
        }else{
            return redirect("/account")
            ->with('error',"密碼輸入錯誤");
        }


        // if ($status == "output"){
        //     $gold = -$gold;
        // }
        // if ($sum+$gold<0){
        //     return redirect("/account")
        //     ->with('error',"餘額不足");
        // }
        // if($gold == 0){
        //     return redirect("/account")
        //     ->with('error',"請輸入金額");
        // }
        // if ($count == 1){
        //     Bank::insertGold($user, $gold, $status);
        //     return redirect("/account")
        //     ->with('success',"成功");
        // } else {
        //     return redirect("/account")
        //     ->with('error',"密碼輸入錯誤");
        // }
    } 
}

