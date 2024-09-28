<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\WebControllers;
use App\Http\Requests\ContactsFormRequest;
use App\Models\Contacts;
use App\Http\Controllers\WebControllers\Controller;
class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
    public function save(ContactsFormRequest $request)
    {
        $data=$request->validated();
//        dd($data);
        Contacts::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'info'=>$request->info
        ]);
        return redirect()->back()->with('message','your complain has been sent successfully');
    }
}
