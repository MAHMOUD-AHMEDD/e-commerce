<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\WebControllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Resources\UserResource;
use App\Models\Contacts;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class DashboardControllerApi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get list of users.
     */
    public function users(): JsonResponse
    {
        $data = User::query()
            ->with('image')
            ->orderBy('id', 'DESC')
            ->paginate(5);

        $users = UserResource::collection($data);

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * Edit a user by ID.
     */
    public function edit_user($id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new UserResource($user)
        ]);
    }

    /**
     * Edit a contact by ID.
     */
    public function edit_contact($id): JsonResponse
    {
        $contact = Contacts::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new ContactResource($contact)
        ]);
    }

    /**
     * Update a user by ID.
     */
    public function update_user(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        $user = User::query()->findOrFail($id);

        if (empty($data['password'])) {
            $data['password'] = $user['password']; // Retain old password if not provided
        }

        $updatedUser = User::query()->updateOrCreate(['id' => $id], $data);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully!',
            'data' => new UserResource($updatedUser)
        ]);
    }

    /**
     * Update a contact by ID.
     */
    public function update_contact(Request $request, $id): JsonResponse
    {
        $data = $request->all();

        $contact = Contacts::query()->updateOrCreate(['id' => $id], $data);

        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully!',
            'data' => new ContactResource($contact)
        ]);
    }

    /**
     * Get all contacts.
     */
    public function contacts(): JsonResponse
    {
        $data = Contacts::all();
        $contacts = ContactResource::collection($data);

        return response()->json([
            'success' => true,
            'data' => $contacts
        ]);
    }

    /**
     * Get all orders.
     */
    public function orders(): JsonResponse
    {
        $orders = Orders::query()
            ->with('product', 'user')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
}
