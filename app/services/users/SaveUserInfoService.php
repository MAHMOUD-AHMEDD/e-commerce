<?php

namespace App\services\users;
use App\Models\User;

class SaveUserInfoService
{
    public static function save($data,$id=null)
    {
        $user=User::query()->updateOrCreate(['id'=>$id],$data);
        return $user;
    }
}
