@extends('backend.index')
@section('content')
<div class="row">
    <div class="col-md-4 stats-info widget">
        <div class="stats-title">
            <h3>Update Product</h3>
        </div>
        <div class="form-body">
            <form method="post" action="{{route('edit_product',$product->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="product_name" id="inputName" placeholder="Product"
                        value="{{$product->product_name}}">
                </div>
                <div class="form-group">
                    <select name="productline[]" class="form-control" multiple>
                        @foreach($productlines as $productline)
                        <option
                            value="{{ $productline->id }} {{ (\App\Models\Product_line::find($productline->id)->products()->where('products.id', $product->id)->exists()) ? 'selected' : '' }}">
                            {{ $productline->productline }}</option>
                        @endforeach
                        <div style="float: right;">{{ $productlines->links("pagination::bootstrap-4") }}</div>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="quantity" id="inputName" placeholder="Quantity"
                        value="{{$product->quantity}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="price" id="inputName" placeholder="Price"
                        value="{{$product->price}}">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="voucher" id="inputName" placeholder="Voucher"
                        value="{{$product->voucher}}">
                </div>
                <div class="form-group has-feedback">
                    <textarea style="height: 150px!important;" class="form-control" id="inputEmail" name="description"
                        placeholder="Description">{{$product->description}}</textarea>
                </div>

                <div class="form-group">
                    <img class="img-thumbnail img-fluid" src="{{ asset('images/'.$product->image) }} " alt="">
                    <input type="file" name="img" class="form-control">
                    <input type="hidden" name="imgName" class="form-control" value="{{ $product->image }}">
                </div>
                <button type="submit" class="label label-info" style="color: black;">Submit</button>
            </form>
        </div>
    </div>
    <div class="col-md-8 stats-info stats-last widget-shadow">
        <table class="table stats-table ">
            <tr>
                <td>
                    <p id="1">Product: </p>{{$product->product_name}}
                </td>
            </tr>
            <tr>
                <td>
                    <p id="1">Productline:</p>
                    @php
                    $arr_productline = [];
                    $productline = $product::find($product->id)->productlines()->get();
                    foreach ($productline as $item) {
                    $arr_productline[] = '<a href="'.route('productline_detail', $item->id).'">'.$item->productline;
                        }
                        echo implode("<br />", $arr_productline);
                        @endphp
                </td>
            </tr>
            <tr>
                <table class="table stats-table">
                    <tr>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Voucher</th>
                    </tr>
                    <tr>
                        <td>{{$product->quantity}}</td>
                        <td>{{number_format($product->price)}}đ</td>
                        <td>{{$product->voucher}}%</td>
                    </tr>
                </table>
            </tr>
            <tr>
                <td>
                    <p id="1">Description: </p>{{$product->description}}
                </td>
                <br>
            </tr>
            <tr>
                <td>
                    <img class="img-thumbnail img-fluid" style="max-width: 50%; height: auto"
                        src="{{ asset('images/'.$product->image) }}" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="clearfix"> </div>
</div>
@endsection