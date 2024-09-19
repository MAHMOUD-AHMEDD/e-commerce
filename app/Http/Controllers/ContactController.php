<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Fixture\PHP81\C;
use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Http\Requests\ContactsFormRequest;
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
