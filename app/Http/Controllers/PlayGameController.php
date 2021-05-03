<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Game;
use App\Models\GameConfig;
use App\Models\GameOdd;
use App\Models\Order;

class PlayGameController extends Controller
{
    public function gameIndex(Request $request, $game_type){

        $user = $request->session()->get('name');
        $request->session()->put('game_type', $game_type);
        
        $getOverage = User::getOverage($user);
        $overage = $getOverage[0]['overage'];
        $getOpenGame = Game::getOpenGame();

        return view('game',compact('getOpenGame','game_type','overage'));
    }

    public function playBingo(Request $request){
        $user = $request->session()->get('name');
        $big = $request->input('big');
        $small = $request->input('small');
        $single = $request->input('single');
        $double = $request->input('double');
        $gtype = $request->session()->get('game_type');
        $getOdd = GameOdd::getOdd($gtype);
        $total = $big + $small + $single + $double;
        
        //賠率
        $bigOdd = $getOdd[0]['odd'];
        $smallOdd = $getOdd[1]['odd'];
        $singleOdd = $getOdd[2]['odd'];
        $doubleOdd = $getOdd[3]['odd'];

        //玩法
        $big_wtype = $getOdd[0]['wtype'];
        $small_wtype = $getOdd[1]['wtype'];
        $single_wtype = $getOdd[2]['wtype'];
        $double_wtype = $getOdd[3]['wtype'];

        $getOverage = User::getOverage($user);
        $overage = $getOverage[0]['overage'];
        
        $status = 0;
        $wingdd = 0;

        // 檢查餘額
        if ($total > $overage){
            return redirect("/user/game/$gtype")
            ->with('error',"金額不足");
        }
        
        // 檢查是否有下注
        if ($total == 0) {
            return redirect("/user/game/$gtype")
            ->with('error',"至少下一注"); 
        }

        // 檢查沒問題則依照玩法下注
        if ($big > 0){
            Order::insertResult($user,$gtype,$big_wtype,$big,$bigOdd,$wingdd,$status);
        }
        if ($small > 0){
            Order::insertResult($user,$gtype,$small_wtype,$small,$smallOdd,$wingdd,$status);
        }
        if ($single > 0){
            Order::insertResult($user,$gtype,$single_wtype,$single,$singleOdd,$wingdd,$status);
        }
        if ($double > 0){
            Order::insertResult($user,$gtype,$double_wtype,$double,$doubleOdd,$wingdd,$status);
        }
        return redirect("/user/game/$gtype")
        ->with('success',"成功");
    }
}