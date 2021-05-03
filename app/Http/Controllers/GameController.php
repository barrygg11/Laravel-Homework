<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameConfig;
use App\Models\Game;
use App\Models\Order;
use App\Models\User;
use App\Models\Bank;
use Illuminate\Support\Arr;

class GameController extends Controller
{

    public function index(){
        $getType = GameConfig::getType();

        foreach ($getType as $key => $type){
            $getGame = Game::getGame($type['type']);
            $getGame[0]['game_name'] = $type['name'];

            switch ($getGame[0]['status']) {
                case 1:
                    $getGame[0]['status_name'] = '開啟';
                    break;
                case 2:
                    $getGame[0]['status_name'] = '已結算';
                    break;
                case 3:
                    $getGame[0]['status_name'] = '取消';
                    break;
                default:
                $getGame[0]['status_name'] = '關閉';
                    break;
            }
            $gameAll[$key] = $getGame;
        }
        
        return view('adminGameControl',['gameAll'=>$gameAll]);
    }

    public function addIndex(){
        $getGameType = GameConfig::getGameType();
        return view('adminGameAdd',compact('getGameType'));
    }

    public function addInsert(Request $request){
        $type = $request->input('type');
        $date = date('Y-m-d');
        $countGameNum = Game::countGameNum($type,$date);
        $gameCount = count($countGameNum);

        if(!empty($type)){

        if ($gameCount == 0) {
            $gameNum = date('Ymd').'001'; // 20210423001
            Game::insertGameNum($type,$gameNum,$date);
            return redirect("/admin/gameAdd")
            ->with('success',"成功");
        } else if ($countGameNum[0]['status'] == 1){
                return redirect("/admin/gameAdd")
                ->with('error',"上一期未關閉");
        } else if ($countGameNum[0]['status'] == 0 || 2 || 3){
            $gameNum = $this->createGameNum($gameCount);
            Game::insertGameNum($type,$gameNum,$date);
            return redirect("/admin/gameAdd")
            ->with('success',"成功");
        }
        } else {
            return redirect("/admin/gameAdd")
            ->with('error',"請選擇遊戲");
        }
    }

    /**
     * 建立期數編號
     */
    public function createGameNum($gameCount) {
        $gameCount = $gameCount + 1;

        if (strlen($gameCount) == 1) {
            $gameNum = date('Ymd'). '00'. $gameCount;
        } else {
            $gameNum = date('Ymd'). '0'. $gameCount;
        }
        return $gameNum;
    }

    public function editSingleStatus($game_id){
        $editSingleStatus = Game::editSingleStatus($game_id);
        return view('adminSwitchStatus',['editSingleStatus'=>$editSingleStatus]);
    }

    public function updateStatus(Request $request){
        $game_id = $request->input('game_id');
        $status = $request->input('status');
        Game::updateStatus($game_id,$status);
        return back()
        ->with('success',"成功");
    }


    // public function closeIndex($game_id){
    //     $editSingleStatus = Game::editSingleStatus($game_id);
    //     return view('close',['editSingleStatus'=>$editSingleStatus]);
    // }


    public function cancelIndex($game_id){
        $editSingleStatus = Game::editSingleStatus($game_id);
        return view('cancel',['editSingleStatus'=>$editSingleStatus]);
    }

    public function closeIndex($game_id){
        $getOpenGame = Game::getOpenGame();
        $editSingleStatus = Game::editSingleStatus($game_id);

        return view('close',['editSingleStatus'=>$editSingleStatus],['getOpenGame' => $getOpenGame]);
    }

    public function closeResult(Request $request){
        $bingo=rand(1,6);
        $getOpenGame = Game::getOpenGame();

        $wtypes = array(
            'big',
            'small',
            'single',
            'double'
        );
        if (!empty($bingo)){
        if($bingo > 3){
            $wtype = $wtypes[0];
            $status = 1;
            Order::closeResult($wtype,$status);
        } else {
            $wtype = $wtypes[0];
            $status = 2;
            Order::closeResult($wtype,$status);
        }
        
        if($bingo < 4){
            $wtype = $wtypes[1];
            $status = 1;
            Order::closeResult($wtype,$status);
        } else {
            $wtype = $wtypes[1];
            $status = 2;
            Order::closeResult($wtype,$status);
        }

        if($bingo == 1 || $bingo == 3 || $bingo == 5){
            $wtype = $wtypes[2];
            $status = 1;
            Order::closeResult($wtype,$status);
        } else {
            $wtype = $wtypes[2];
            $status = 2;
            Order::closeResult($wtype,$status);
        }

        if($bingo == 2 || $bingo == 4 || $bingo == 6){
            $wtype = $wtypes[3];
            $status = 1;
            Order::closeResult($wtype,$status);
        } else {
            $wtype = $wtypes[3];
            $status = 2;
            Order::closeResult($wtype,$status);
        }

        $adminAccountManagement =User::AdminAccountManagement();
        foreach($adminAccountManagement as $name){
            $user = $name['name'];
            $bankSum =Bank::sumGold($user);
            $sum1 = Order::sum1($user);
            $sum2 = Order::sum2($user);
            $sum = $bankSum + $sum1 - $sum2;
            User::updateOverage($user,$sum);
        }

    } 
        
        return back()
        ->with('success',$getOpenGame[0]['game_num']."期, 已結算")
        ->with('error',"賽果：".$bingo);
    }

}