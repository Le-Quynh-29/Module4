@extends('backend.index')
@section('content')
    <div class="row">
        <div class="col-md-4 stats-info widget">
            <div class="stats-title">
                <h3>Update Productline</h3>
            </div>
            <div class="form-body">

                <form method="post" action="{{route('edit_productline', $product_line->id)}}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="productline" id="inputName"
                               placeholder="Productline" value="{{$product_line->productline}}">
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control" id="inputEmail" name="description"
                                  style="height: 150px!important;"
                                  placeholder="Description"> {{$product_line->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <img class="img-thumbnail img-fluid" src="{{ asset('images/'.$product_line->image) }} " alt="">
                        <input type="hidden" name="imgName" class="form-control" value="{{ $product_line->image }}">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" class="label label-info" style="color: black;">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-8 stats-info stats-last widget-shadow">
            <table class="table stats-table ">
                <tr>
                    <td><p id="1">Productline: </p>{{$product_line->productline}}</td>
                </tr>
                <tr>
                    <td><p id="1">Product:</p>
                        @php
                            $arr_product = [];
                            $productline_id = $product_line->id;
                            $product = \App\Models\Product::whereHas('productlines', function (\Illuminate\Database\Eloquent\Builder $q) use ($productline_id) {
                                $q->where("product_lines.id", "=", $productline_id);
                            })->get();
                            if (!empty($product[0])) {
                                foreach ($product as $item) {
                                    $arr_product[] = '<a href="'.route('product_detail', $item->id).'">'.$item->product_name.'</a>';
                                }
                                echo implode("<br/>", $arr_product);
                            }
                            else {
                                echo "No product";
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td><p id="1">Description: </p>{{$product_line->description}}</td>
                </tr>
                <tr>
                    <td>
                        <img class="img-thumbnail img-fluid" style="max-width: 50%; height: auto"
                             src="{{ asset('images/'.$product_line->image) }}" alt="">
                    </td>
                </tr>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
