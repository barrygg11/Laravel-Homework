<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $connection;
    protected $table = 'game';
    protected $primaryKey = 'game_id';
    public $timestamps = false;

    public static function insertGameNum($type,$today,$date){
        $insertGameNum = self::insert(
            ['game_num' => $today, 'game_type' => $type, 'status' => 1, 'result'=> null, 'date'=>$date]
        );
        return $insertGameNum;
    }

    public static function getGame($type){
        $getGame = self::select('game_id','game_type','game_num','status')
        ->where('game_type',$type)
        ->orderBy('game_num','desc')
        ->take(1)
        ->get()
        ->toArray();
        return $getGame;
    }

    public static function editSingleStatus($game_id){
        $editSingleStatus = self::select('game_id','game_type','game_num','status')
        ->where('game_id',$game_id)
        ->get();
        return $editSingleStatus;
    }

    /**
     * 取得指定日期指定遊戲期數資訊
     */
    public static function countGameNum($type,$date){
        $countGameNum = self::where('game_type',$type)
        ->where('date',$date)
        ->orderBy('game_num','desc')
        ->get()
        ->toArray();
        return $countGameNum;
    }
    
    public static function updateStatus($game_id,$status){
        $updateStatus = self::where('game_id','=',$game_id)
        ->update(['status'=>$status]);
        return $updateStatus;
    }

    public static function getOpenGame(){
        $getOpenGame = self::join('gameconfig','game.game_type','=','gameconfig.type')
        ->select('game.game_id','game.game_type','game.game_num','gameconfig.name')
        ->where('game.status','1')
        ->get()
        ->toArray();
        return $getOpenGame;
    }

    // public static function getCurrentNum($game_id){
    //     $getCurrentNum = self::select('game_num')
    //     ->where('game_id',$game_id)
    //     ->get()
    //     ->toArray();
    //     return $getCurrentNum;
    // }
}
