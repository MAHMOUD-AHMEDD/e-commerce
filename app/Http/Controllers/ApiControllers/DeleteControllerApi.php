<?php

namespace App\Http\Controllers\ApiControllers;

use App\actions\DeleteFileFromPublicAction;
use App\Http\Controllers\WebControllers\Controller;
use App\Models\Images;
use App\Services\Messages;
use Illuminate\Http\Request;
use App\Http\Requests\DeleteFormRequest;
class DeleteControllerApi extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(DeleteFormRequest $request)
    {
        if (request('model_name') == 'images') {
            $image = Images::query()->find(request('id'));
            $image->delete();
            DeleteFileFromPublicAction::delete('images', $image->name);

        } else {
            $modelClass = 'App\Models\\' . request('model_name');
            $item = $modelClass::query()->find(request('id'));
            if ($item){
                $item->delete();
            }
        }

        return Messages::success('', 'Element has been deleted successfully');
    }
}
