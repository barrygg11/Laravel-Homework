<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $connection;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function insertResult($user_id, $gtype, $wtype, $gold, $odd, $wingdd, $status){
        $insertResult = self::insert(
            ['user_id'=>$user_id, 'gtype'=>$gtype, 'wtype'=>$wtype, 'gold'=>$gold, 'odd'=>$odd, 'wingdd'=>$wingdd, 'status' => $status, 'time'=>now()]
        );
        return $insertResult;
    }

    public static function sum1($user_id){
        $sum1 = self::where('user_id', $user_id)
        ->where('status',1)
        ->sum('wingdd');
        return $sum1;
    }

    public static function sum2($user_id){
        $sum2 = self::where('user_id', $user_id)
        ->where('status',2)
        ->sum('wingdd');
        return $sum2;
    }

    public static function sum3($user_id){
        $sum3 = self::where('user_id', $user_id)
        ->where('status',3)
        ->sum('wingdd');
        return $sum3;
    }

    public static function closeResult($wtype,$status){
        $closeResult = self::where('wtype',$wtype)
        ->update(['status' => $status]);
        return $closeResult;
    }

}
