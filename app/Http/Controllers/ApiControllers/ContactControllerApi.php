<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\WebControllers\Controller;
use App\Http\Requests\ContactsFormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Contacts;
class ContactControllerApi extends Controller
{
    public function save(ContactsFormRequest $request): JsonResponse
    {
        // Validate the request data
        $data = $request->validated();

        // Create the contact
        $contact = Contacts::create([
            'name'  => $data['name'],
            'email' => $data['email'],
            'info'  => $data['info']
        ]);

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Your complaint has been sent successfully',
            'data'    => $contact,
        ], 201);
    }
}
