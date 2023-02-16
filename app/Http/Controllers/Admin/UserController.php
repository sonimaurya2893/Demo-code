<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfileImage;

class UserController extends Controller
{
    public function createRecord(){
        $user = new User;
        $user->name = "Ram";
        $user->email = "ram@gmail.com";
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->save();

        if($user){
            $pImg  = new ProfileImage;
            $pImg->profile_image = 'images/avatar.png';
            $user->profileImage()->save($pImg);
        }
        dd("success");
    }

    //save same record for other
    public function associateRecord(){
        $user = User::find(2);
        $pImg  =ProfileImage::find(1);
        $pImg->user()->associate($user)->save();
        if($pImg){
            dd('success');
        }
    }

    public function retrive(){
        dd(User::find(3)->profileImage->toArray());
    }
}
