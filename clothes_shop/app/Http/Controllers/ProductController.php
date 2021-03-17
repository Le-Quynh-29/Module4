<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequest_Products;
use App\Models\Product;
use App\Models\Product_line;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(4);
        // $pl = ProductLine::paginate(3);
        // $count = Cart::count();
        // dd($products);
        return view('frontend.product.product',compact('products'));
    }

    public function listBackend()
    {
        $products = Product::paginate(4);
        $productline = Product_line::paginate(4);
        // dd($products);
        return view('backend.product.list_product',compact('products', 'productline'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productline = Product_line::all();
        return view('backend.product.list_product', compact('productline'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequest_Products $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $image_name);
            $product->fill($request->all());
            $product->image = $image_name;
            $product->save();
            foreach ($request->productline_id as $productline) {
                Product_line::find($productline)->products()->attach($product->id);
            }
            return redirect()->route('show_product_backend');
            }
        else {

            return redirect()->route('show_product_backend');
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $productlines = Product_line::paginate(4);
        return view("backend.product.edit_detail", compact('product','productlines'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($request->id);
        $product->fill($request->all());
        if (!$request->hasFile('img') && file_exists(public_path('images') . "/" . $request->imgName)) {
            $product->image = $request->imgName;
        } else {
            if (file_exists(public_path('images') . "/" . $request->imgName)) {
                unlink(public_path('images') . "/" . $request->imgName);
            }
            $imageName = time() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }
        $product->save();
        foreach ($request->productline as $productline) {
            $exist_product_id_pivot = Product_line::find($productline)->products()->where('products.id', $product->id)->exists();
            if (!$exist_product_id_pivot) {
                Product_line::find($productline)->products()->attach($product->id);
            }
        }

//        foreach ($request->productline as $productline) {
//            Product_line::find($productline)->products()->attach($product->id);
//        }

        $productlines = Product_line::all();
        $list_expect = [];
        foreach ($productlines as $productline) {
            if (in_array($productline->id, $request->productline) === false) {
                $list_expect[] = $productline->id;
            }
        }
        if (!empty($list_expect)) {
            foreach ($list_expect as $item) {
                Product_line::find($item)->products()->detach($product->id);
            }
        }
        return redirect()->route('product_detail', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        $product = Product::findOrFail($request->id);
        if (file_exists(public_path('images') . "/" . $product->image)) {
            unlink(public_path('images') . "/" . $product->image);
        }
        $product->productlines()->detach();
        $product->delete();
        return redirect()->route('show_product_backend');
    }

    public function showLastProduct()
    {
        $products = Product::paginate(12);
        $product = Product::with('productlines')->latest()->paginate(8);
//        dd($product);
        $productlines = Product_line::paginate(4);
//        return response()->json($product);
        return view('frontend.product.last_product',  compact('products','product','productlines'));
    }
}
