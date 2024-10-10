<?php

namespace App\Http\Controllers\WebControllers;

use App\Models\FavoriteProducts;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\WebControllers\Controller;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function edit_user()
    {
        $id=auth()->id();
//        $user= User::query()->findOrFail($id)->with('image')->get();
        $user=User::query()->where('id','=',$id)->with('image')->get();
//        dd($user);
//        dd($user[0]->image->name);

        return view('user.profile',[
            'user'=>$user[0]
            ]
        );

    }
    public function update_user(Request $request){
        $data = $request->all();
        $userr=User::with('image')->findOrFail(auth()->id());
//        dd($userr);
        $file = request()->file('image');
        if ($file == null){
            $image_name = 'default.png';
        }else{
            $image_name= $this->uploadImage($file,'users');
        }
        if(empty($data['password'])) {
            $data['password'] = $userr->password;
        }
        $user = User::query()->updateOrCreate(['id' => auth()->id()], $data);

        return redirect()->back()->with('success', 'Updated successfully!');
    }
    public function showFavourite()
    {
//        dd('working');
        $user=User::query()->where('id','=',auth()->id())->with('FavoriteProducts')->get();
        $favourites=FavoriteProducts::query()->where('user_id','=',auth()->id())->with('product')->paginate(10);
//        dd($favourites);
//        dd($user[0]->FavoriteProducts);
        return view('user.favourite',[
            'favourites'=>$favourites,

        ]);
    }
    public function notification()
    {
        $notifications=DB::table('notifications')->where('notifiable_id','=',auth()->id())->get();
//        dd(json_decode($notifications[0]->data));
        foreach ($notifications as $notification){
            $notification->data=json_decode($notification->data);
        }
//        $notifications=json_decode($notifications);

        return view('user.notification',compact('notifications'));
    }
}
