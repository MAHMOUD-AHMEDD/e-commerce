<?php

namespace App\Http\Controllers\WebControllers;

use App\Events\SaveProductEvent;
use App\Http\Requests\ProductFormRequest;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\Request;
//use http\Env\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FavoriteProducts;
use App\Http\Controllers\WebControllers\Controller;
use function PHPUnit\Framework\isEmpty;
use function Webmozart\Assert\Tests\StaticAnalysis\isEmptyArray;

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
        $category = Categories::with('products')->findOrFail($category_id);
        $products = $category->products()->paginate(10);
        return view('products.index',[
            'products'=>$products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Products::query()->with('images')->with('categories')->find($id);
//        dd((auth()->user()->type != 'admin'&&auth()->user()->type != 'supplier' ) );
//        || $product->supplier_id != auth()->id() || auth()->user()['type'] != 'admin'
        if($product==null ){
            return redirect()->to('/products');
        }
        elseif (auth()->user()['type'] == 'admin'){
            $categories=Categories::all();
            return view('products.save')->with('data',$product)->with('categories',$categories);
        }
        elseif($product->supplier_id != auth()->id()){
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
    public function addToFavourite($id)
    {
        $product=Products::query()->where('id','=',$id);
        $find=FavoriteProducts::query()->where('user_id','=',auth()->id())->where('product_id','=',$id)->get();
//        dd(sizeof($find));
        if(sizeof($find)){
            return redirect()->back()->with('error','item already in the favorite');
        }
        $favourite=FavoriteProducts::query()->create([
            'user_id'=>auth()->id(),
            'product_id'=>$id,
        ]);
        return redirect()->back()->with('success','item has been added to favourite');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
