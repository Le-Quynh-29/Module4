@extends('frontend.index')
@section('content')
    <section class="homepage-slider" id="home-slider">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="{{asset('frontend/themes/images/carousel/banner-1.jpg')}}" alt=""/>
                </li>
                <li>
                    <img src="{{asset('frontend/themes/images/carousel/banner-2.jpg')}}" alt=""/>
                    <div class="intro">
                        <h1>Mid season sale</h1>
                        <p><span>Up to 50% Off</span></p>
                        <p><span>On selected items online and in stores</span></p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="header_text">
        We stand for top quality templates. Our genuine developers always optimized bootstrap commercial templates.
        <br/>Don't miss to use our cheap abd best bootstrap templates.
    </section>
    <section class="main-content">
        <div class="row">
            <div class="span12">
                @yield('last_product')

                <div class="row">
                    <div class="span12">
                        <h4 class="title">
                            <span class="pull-left"><span class="text"><span
                                        class="line">List <strong>Products</strong></span></span></span>
                            <span class="pull-right">
										<a class="left button" href="#myCarousel" data-slide="prev"></a><a
                                    class="right button" href="#myCarousel" data-slide="next"></a>
									</span>
                        </h4>
                        <div id="myCarousel" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails">
                                        @foreach($products as $key => $val)
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
                                        <div
                                            style="float: right;">{{ $products->links("pagination::bootstrap-4") }}</div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <div class="row feature_box">
                    <div class="span4">
                        <div class="service">
                            <div class="responsive">
                                <img src="{{asset('frontend/themes/images/feature_img_2.png')}}" alt=""/>
                                <h4>MODERN <strong>DESIGN</strong></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown
                                    printer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="service">
                            <div class="customize">
                                <img src="{{asset('frontend/themes/images/feature_img_1.png')}}" alt=""/>
                                <h4>FREE <strong>SHIPPING</strong></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown
                                    printer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="service">
                            <div class="support">
                                <img src="{{asset('frontend/themes/images/feature_img_3.png')}}" alt=""/>
                                <h4>24/7 LIVE <strong>SUPPORT</strong></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown
                                    printer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our_client">
        <h4 class="title"><span class="text">Manufactures</span></h4>
        <div class="row">
            <div class="span2">
                <a href="#"><img alt="" src="{{asset('frontend/themes/images/clients/14.png')}}"></a>
            </div>
            <div class="span2">
                <a href="#"><img alt="" src="{{asset('frontend/themes/images/clients/35.png')}}"></a>
            </div>
            <div class="span2">
                <a href="#"><img alt="" src="{{asset('frontend/themes/images/clients/1.png')}}"></a>
            </div>
            <div class="span2">
                <a href="#"><img alt="" src="{{asset('frontend/themes/images/clients/2.png')}}"></a>
            </div>
            <div class="span2">
                <a href="#"><img alt="" src="{{asset('frontend/themes/images/clients/3.png')}}"></a>
            </div>
            <div class="span2">
                <a href="#"><img alt="" src="{{asset('frontend/themes/images/clients/4.png')}}"></a>
            </div>
        </div>
    </section>
@endsection
