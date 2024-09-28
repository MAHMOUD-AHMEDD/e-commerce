<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\WebControllers\Controller;

use App\services\reviews\SaveReviewsService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class ReviewsControllerApi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Add a review for a product.
     */
    public function add(Request $request, $product_id): JsonResponse
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        try {
            SaveReviewsService::make($product_id, $validatedData['rating'], $validatedData['comment']);
            return response()->json([
                'success' => true,
                'message' => 'Your review has been added to the product'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
