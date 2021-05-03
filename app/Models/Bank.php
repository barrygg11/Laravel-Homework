<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $connection;
    protected $table = 'bank';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // 輸入存提款資料
    public static function insertGold($user, $gold, $status){
        $insertGold = self::insert(
            ['user' => $user, 'gold' => $gold, 'status' => $status, 'time' => now()]
        );
        return $insertGold;
    }

    // 計算金額總和
    public static function sumGold($user){
        $sumGold = self::select('user')
            ->where('user','=',$user)
            ->sum('gold');
        return $sumGold;
    }

    //顯示指定使用者存提款資料
    public static function selectGold($user){
        $selectGold = self::select('user','gold','status','time')
        ->where('user', $user)
        ->orderBy('time','desc')
        ->get();
        return $selectGold;
    }

    //顯示所有使用者存提款資料
    public static function getUserData($user, $status, $time, $take){
        if($user == "" && $status == "" && $time == "" && $take ==""){
            $getUserData = self::take(10)
            ->orderBy('time', 'desc')
            ->get();
            return $getUserData;
        }

        $query = $getUserData = self::select('user','gold','status','time')
        ->orderBy('time', 'desc');
        if(!empty($user)){
            $query->where('user', '=', $user);
        }
        if(!empty($status)){
            $query->where('status', '=', $status);
        }
        if(!empty($time)){
            $query->where('time', 'like','%'.$time.'%');
        }
        // $query->select('user','gold','status','time');
        $getUserData = $query->take($take)->get();
        return $getUserData;

        // // 100
        // if($user != "" && $status == "" && $time == ""){
        // $getUserData = self::select('user','gold','status','time')
        // ->where('user', '=', $user)
        // ->orderBy('time', 'desc')
        // ->take($take)
        // ->get();
        // return $getUserData;
        // }
        // //010
        // if($user == "" && $status != "" && $time == ""){
        //     $getUserData = self::select('user','gold','status','time')
        //     ->where('status', '=', $status)
        //     ->orderBy('time', 'desc')
        //     ->take($take)
        //     ->get();
        //     return $getUserData;
        // }
        // //001
        // if($user == "" && $status =="" && $time != ""){
        //     $getUserData = self::select('user','gold','status','time')
        //     ->where('time', 'like','%'.$time.'%')
        //     ->orderBy('time', 'desc')
        //     ->take($take)
        //     ->get();
        //     return $getUserData;
        // }
        // //101
        // if($user != "" && $status =="" && $time != ""){
        //     $getUserData = self::select('user','gold','status','time')
        //     ->where('user','=',$user)
        //     ->where('time', 'like','%'.$time.'%')
        //     ->orderBy('time', 'desc')
        //     ->take($take)
        //     ->get();
        //     return $getUserData;
        // }
        // //111
        // if($user != "" && $status != "" && $time != ""){
        //     $getUserData = self::select('user','gold','status','time')
        //     ->where('user','=',$user)
        //     ->where('status','=',$status)
        //     ->where('time', 'like','%'.$time.'%')
        //     ->orderBy('time', 'desc')
        //     ->take($take)
        //     ->get();
        //     return $getUserData;
        // }
        // //011
        // if($user =="" && $status != "" && $time != ""){
        //     $getUserData = self::select('user','gold','status','time')
        //     ->where('status','=',$status)
        //     ->where('time', 'like','%'.$time.'%')
        //     ->orderBy('time', 'desc')
        //     ->take($take)
        //     ->get();
        //     return $getUserData;
        // }
        // //110
        // if($user != "" && $status != "" && $time == ""){
        //     $getUserData = self::select('user','gold','status','time')
        //     ->where('user','=',$user)
        //     ->where('status','=',$status)
        //     ->orderBy('time', 'desc')
        //     ->take($take)
        //     ->get();
        //     return $getUserData;
        // }
    }
    // public static function getUserData($user, $status, $time, $take){
    //     $getUserData = self::select('user','gold','status','time')
    //     ->where('user','=',$user)
    //     ->where('status','=',$status)
    //     ->where('time','=',$time)
    //     ->orderBy('time', 'desc')
    //     ->take($take)
    //     ->get();
    //     return $getUserData;
    // }
}
