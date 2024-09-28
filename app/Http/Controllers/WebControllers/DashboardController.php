<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Resources\ContactResource;
use App\Http\Resources\UserResource;
use App\Models\Contacts;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\WebControllers\Controller;

//use FormRequest

class DashboardController extends Controller
{
    public function users()
    {
        $data = User::query()
            ->with('image')
            ->orderBy('id','DESC')
            ->paginate(5);
//            ->get();
        $users=UserResource::collection($data);
        return view('admin.users',compact('users'));
    }
    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));

    }
    public function edit_contact($id)
    {
        $contact = Contacts::findOrFail($id);
        return view('admin.edit_contact', compact('contact'));

    }
    public function update_user(Request $request, $id){
        $data = $request->all();
        $userr=User::query()->findOrFail($id);
//        dd($userr);
        if(empty($data['password'])) {
            $data['password'] = $userr['password'];
        }
//        dd($data);
        $user = User::query()->updateOrCreate(['id' => $id], $data);
//        dd($user);
        return redirect()->route('dashboard.edit.user', $user->id)->with('success', 'Updated successfully!');
    }
    public function update_contact(Request $request, $id){
        $data = $request->all();
//        dd($data);
        $contact = Contacts::query()->updateOrCreate(['id' => $id], $data);
        return redirect()->route('dashboard.edit.contact', $contact->id)->with('success', 'Updated successfully!');
    }

    public function contacts()
    {
        $data = Contacts::all();

        $contacts=ContactResource::collection($data);
//        return $contacts;
        return view('admin.contacts',compact('contacts'));
    }
    public function orders()
    {
        $orders = Orders::query()->with('product')->with('user')->paginate(10);
//        dd($data);
//        $orders=OrdersResource::collection($data);
//        return $contacts;
        return view('admin.orders',compact('orders'));
    }
}
