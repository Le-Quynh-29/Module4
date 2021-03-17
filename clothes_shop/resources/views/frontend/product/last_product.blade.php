@extends('frontend.product.product')
@section('last_product')
    <div class="row">
        <div class="span12">
            <h4 class="title">
                <span class="pull-left"><span class="text"><span
                            class="line">New <strong>Products</strong></span></span></span>
                <span class="pull-right">
										<a class="left button" href="#myCarousel-2" data-slide="prev"></a><a
                        class="right button" href="#myCarousel-2" data-slide="next"></a>
									</span>
            </h4>
            <div id="myCarousel-2" class="myCarousel carousel slide">
                <div class="carousel-inner">
                    <div class="active item">
                        <ul class="thumbnails">
                            @foreach($product as $key => $val)
                                <li class="span3">
                                    <div class="product-box">
                                        <span class="sale_tag"></span>
                                        <p><a href="product_detail.html">
                                                <img class="img-thumbnail img-fluid"
                                                     style="width: 169px; height:220px"
                                                     src="{{ asset('images/'.$val->image) }}" alt=""></a>
                                        </p>
                                        @if($val->voucher != 0)
                                            <span>{{$val->voucher}}%</span>
                                        @else
                                        @endif
                                        <h5>{{$val->product_name}}</h5>

                                        @php
                                            $arr_product = [];
                                            $product_id = $val->id;
                                            $product = \App\Models\Product_line::whereHas('products', function (\Illuminate\Database\Eloquent\Builder
                                            $q) use ($product_id) {
                                            $q->where("products.id", "=", $product_id);
                                            })->take(2)->get();
                                            foreach ($product as $item) {
                                            $arr_product[] = '<a href="" class="title">'.$item->productline.'</a>';
                                            }
                                            echo implode(", ", $arr_product);
                                        @endphp
                                        <br/>
                                        @if($val->voucher != 0)

                                            {{--														<a href="product_detail.html" class="title">Ut wisi enim ad</a><br/>--}}
                                            {{--														<a href="products.html" class="category">Commodo consequat</a>--}}
                                            <del class="price">{{number_format($val->price)}}đ</del>
                                            <p class="price">{{number_format($val->price * (1 - $val->voucher/100))}}
                                                đ</p>
                                        @else
                                            <p class="price">{{number_format($val->price)}}đ</p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
{{--                                <div style="float: right;">{{ $product->links("pagination::bootstrap-4") }}</div>--}}

                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
