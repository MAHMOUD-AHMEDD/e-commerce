<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\WebControllers\Controller;
use App\Models\User;
use App\Services\Orders\SaveOrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrdersControllerApi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display the user's orders.
     */
    public function index(Request $request): JsonResponse
    {
        $user = User::with('orders.product.images')->findOrFail(auth()->id());
        $orders = $user->orders;

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    /**
     * Add a product to the user's cart.
     */
    public function add(Request $request, $product_id): JsonResponse
    {
        $quantity = $request->input('quantity');
        try {
            SaveOrderService::make($quantity, $product_id);
            return response()->json([
                'success' => true,
                'message' => 'Item has been added to the cart'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the checkout page with the user's orders.
     */
    public function checkout(Request $request): JsonResponse
    {
        $user = User::with('orders.product')->findOrFail(auth()->id());
        $orders = $user->orders;

        return response()->json([
            'success' => true,
            'user' => $user,
            'orders' => $orders
        ], 200);
    }

    /**
     * Show order confirmation details.
     */
    public function confirmation(Request $request): JsonResponse
    {
        $user = User::findOrFail(auth()->id());

        return response()->json([
            'success' => true,
            'user' => $user
        ], 200);
    }
}
