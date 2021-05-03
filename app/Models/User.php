<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    //驗證登入
    public static function getUser($name, $password){
        $getUser = self::select('name', 'password')
            ->where('name','=',$name)
            ->Where('password','=',$password)
            ->get()
            ->toArray();
        return $getUser;
    }

    //編輯密碼
    public static function editUser($name, $password){
        $editUser = self::where('name', $name)
        ->update(['password' => $password]);
        return $editUser;
    }

    //顯示所有帳號
    public static function AdminAccountManagement(){
        $adminAccountManagement = self::where('level', 'user')
        ->get();
        return $adminAccountManagement;
    }

    //刪除帳號
    public static function AdminDeleteAccount($user_id){
        $adminDeleteAccount = self::where('user_id',$user_id)
        ->delete();
        return $adminDeleteAccount;
    }

    public static function updateOverage($name,$overage){
        $updateOverage = self::where('name',$name)
        ->update(['overage' => $overage]);
        return $updateOverage;
    }

    public static function getOverage($name){
        $getOverage = self::select('overage')
        ->where('name',$name)
        ->get()
        ->toArray();
        return $getOverage;
    }
}