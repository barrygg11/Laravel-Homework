<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameOdd extends Model
{
    use HasFactory;

    protected $connection;
    protected $table = 'gameodds';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getOdd($gtype){
        $getOdd = self::select('gtype','wtype','odd')
        ->where('gtype',$gtype)
        ->get()
        ->toArray();
        return $getOdd;
    }

    // public static function getGameOdd($wtype){
    //     $getGameOdd = self::select('')
    // }
}
