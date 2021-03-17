<?php

namespace App\Http\Controllers;

use App\Models\Product_line;
use Illuminate\Http\Request;
use App\Http\Requests\FormRequest_Productline;


class ProductLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_line = Product_line::paginate(4);
        return view('backend.productline.productline',compact('product_line'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.productline.productline');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequest_Productline $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $image_name);
            $product_line = new Product_line([
                     'productline'      =>  $request->get('productline'),
                     'description'       =>  $request->get('description'),
                     'image'            =>  $image_name,
                 ]);
                 $product_line->save();

                return redirect()->route('show_productline');

          }
            else {
                
            return redirect()->route('show_productline');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_line  $product_line
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product_line $product_line)
    {
        $product_line = Product_line::findOrFail($request->id);
        return view('backend.productline.edit_detail', compact('product_line'));
//        return response()->json($productline);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_line  $product_line
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_line $product_line,Request $request)
    {
        $product_line = $product_line::findOrFail($request->id);
        $product_line->fill($request->all());
        if (!$request->hasFile('image') && file_exists(public_path('images') . "/" . $request->imgName)) {
            $product_line->image = $request->imgName;
        } else {
            if (file_exists(public_path('images') . "/" . $request->imgName)) {
                unlink(public_path('images') . "/" . $request->imgName);
            }
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $product_line->image = $imageName;
        }

//        dd($product_line);
        $product_line->save();
        return redirect()->route('productline_detail',$product_line->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_line  $product_line
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_line $product_line)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_line  $product_line
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_line = Product_line::findOrFail($id);
        $product_line->delete();
        return redirect()->route('show_productline');
    }
}
