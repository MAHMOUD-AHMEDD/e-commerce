<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\WebControllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Http\Requests\ProductFormRequest;
use App\Events\SaveProductEvent;
use App\Models\Categories;
class ProductControllerApiResource extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'show_category']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Products::with('images')->orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            event(new SaveProductEvent($request->except('images'), $request->file('images')));
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product Created Successfully'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $product = Products::query()->where('id', $id)
            ->with(['images', 'reviews.user.image'])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }
    public function show_category($category_id): JsonResponse
    {
        $category = Categories::with('products')->findOrFail($category_id);
        $products = $category->products()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $product = Products::with(['images', 'categories'])->findOrFail($id);

            // Ensure at least one image is uploaded
            if ($product->images->isEmpty() && !$request->hasFile('images')) {
                return response()->json([
                    'success' => false,
                    'message' => 'You should upload one photo at least'
                ], 422);
            }

            $basic_data = $request->except('images');
            $basic_data['id'] = $id;
            $basic_data['supplier_id'] = $product->supplier_id;

            event(new SaveProductEvent($basic_data, $request->file('images') ?? [], false));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
