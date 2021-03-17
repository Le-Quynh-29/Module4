@extends('backend.index')
@section('content')
<div class="row">
    <div class="col-md-4 stats-info widget">
        <div class="stats-title">
            <h3>Create Product</h3>
        </div>
        <div class="form-body">
            <form method="post" action="{{route('create_product')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="product_name" id="inputName" placeholder="Product">
                    @if($errors->any())
                        <p class="alert-danger my-sm-4">{{ $errors->first('product_name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <select size="5" name="productline_id[]" class="form-control" multiple>
                        @foreach($productline as $val)
                        <option value="{{$val->id}}">{{$val->productline}}</option>
                        @endforeach
                        <div style="float: right;">{{ $productline->links("pagination::bootstrap-4") }}</div>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="quantity" id="inputName" placeholder="Quantity">
                    @if($errors->any())
                        <p class="alert-danger my-sm-4">{{ $errors->first('quantity') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="price" id="inputName" placeholder="Price">
                    @if($errors->any())
                        <p class="alert-danger my-sm-4">{{ $errors->first('price') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="voucher" id="inputName" placeholder="Voucher">
                    @if($errors->any())
                        <p class="alert-danger my-sm-4">{{ $errors->first('voucher') }}</p>
                    @endif
                </div>
                <div class="form-group has-feedback">
                    <textarea class="form-control" id="inputEmail" name="description" placeholder="Description"></textarea>
                    @if($errors->any())
                        <p class="alert-danger my-sm-4">{{ $errors->first('description') }}</p>
                    @endif

                </div>

                <div class="form-group">
                    <input type="file" name="image" class="form-control">
                    @if($errors->any())
                        <p class="alert-danger my-sm-4">{{ $errors->first('image') }}</p>
                    @endif
                </div>
                <button type="submit" class="label label-info" style="color: black;">Submit</button>
            </form>
        </div>
    </div>
    <div class="col-md-8 stats-info stats-last widget-shadow">
        <table class="table stats-table ">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Product</th>
                    <th>Productline</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $val)
                <tr>
                    <th scope="row">{{$key + $products->firstItem()}}</th>
                    <td><a href="{{route('product_detail', $val->id)}}">{{$val->product_name}}</a></td>
                    <td>
                        @php
                        $arr_product = [];
                        $product_id = $val->id;
                        $product = \App\Models\Product_line::whereHas('products', function (\Illuminate\Database\Eloquent\Builder
                        $q) use ($product_id) {
                        $q->where("products.id", "=", $product_id);
                        })->take(2)->get();
                        foreach ($product as $item) {
                        $arr_product[] = '<a href="'.route('productline_detail', $item->id).'">'.$item->productline.'</a>';
                        }
                        echo implode("<br /><br />", $arr_product);
                        @endphp
                    </td>
					<td>{{$val->quantity}}</td>
                    <td>
					<img class="img-thumbnail img-fluid" style="width:100px !important ;height: 100px !important"
                            src="{{ asset('images/'.$val->image) }}" alt="">
                    </td>
                    <td>
					<a class="label label-danger" href="{{ route('delete_product',$val->id) }}"
                            onclick="return confirm('Bạn chắc chắn muốn xóa?')">Delete</a>
					</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="float: right;">{{ $products->links("pagination::bootstrap-4") }}</div>

    </div>
</div>

@endsection
