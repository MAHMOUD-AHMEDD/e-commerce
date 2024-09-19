<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\SaveProductEvent;
use App\Models\Categories;
use App\Models\Reviews;
class ProductControllerResource extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Products::query()->with('images')->orderBy('id','DESC')->paginate(10);
//        dd($products);
//        $categories=Categories::query()->select('name')->get();
//        dd($categories[0]->name);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('products.save', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        DB::beginTransaction();
        event(new SaveProductEvent(request()->except('images'),request()->file('images')));
        DB::commit();
        return redirect()->back()->with('message','Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Products::query()->where('id','=',$id)->with('images')->with('reviews.user.image')->get();
//        $reviews=Reviews::query()->->get();
//        dd($product);
//        dd($product[0]['images'][0]['name']);
//        $reviews=Reviews::query()->where('product_id','=',$id);
//        $user=User::query()->where('id','=',auth()->id())->get();
//        dd($product[0]['reviews'][0]);
        return view('products.show', [
            'product' => $product,
//            'reviews' => $reviews,
        ]);
    }
    public function show_category($category_id)
    {
        $products=Categories::query()->with('products')->where('id','=',$category_id)->get();
//        dd($products[0]->products);
        return view('products.index',[
            'products'=>$products[0]->products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Products::query()->with('images')->with('categories')->find($id);
//        dd((auth()->user()->type != 'admin'&&auth()->user()->type != 'supplier' ) );
        if($product==null || $product->supplier_id != auth()->id() || (auth()->user()->type != 'admin'&&auth()->user()->type != 'supplier' )){
            return redirect()->to('/products');
        }
        $categories=Categories::all();
        return view('products.save')->with('data',$product)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id)
    {
        DB::beginTransaction();
        $product=Products::query()->with('images')->with('categories')->find($id);
//        dd($product);
        if(sizeof($product->images)==0&&request()->hasFile('images')==false){
            return redirect()->back()->withErrors(['error'=>'You should upload one photo at least']);
        }
        $basic_data=request()->except('images');
        $basic_data['id']=$id;
        $basic_data['supplier_id']=$product->supplier_id;
        event(new SaveProductEvent($basic_data,
            request()->file('images')??[],false));
        DB::commit();
        return redirect()->back()->with('message','product Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
