<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameConfig extends Model
{
    protected $connection;
    protected $table = 'gameconfig';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // use HasFactory;

    public static function getGameType(){
        $getGameType = self::select('name')
        ->get();
    return $getGameType;
    }
    
    public static function getType(){
        $getType = self::select('type','name')
        ->get()
        ->toArray();
    return $getType;
    }
}