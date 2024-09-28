<?php

namespace App\Http\Controllers\WebControllers;

use App\Actions\DeleteFromPublicAction;
use App\Models\Images;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\WebControllers\Controller;

class DeleteController extends Controller
{
    public function delete()
    {
        if (request()->filled('model_name') && request()->filled('id')) {


            if (request('model_name') =='Images') {
                $image = Images::query()->find(request('id'));
            DeleteFromPublicAction::delete('images',$image->name);
            }


//            $item =('App\Models\\' . request('model_name'))::query()->find(request('id'));
//            if($item != null){
//                $item->delete();
//                return redirect()->back();

            DB::select('DELETE FROM ' . request('model_name') . ' WHERE id=' . request('id'));
            return redirect()->back();
        }
//        }
    }
}