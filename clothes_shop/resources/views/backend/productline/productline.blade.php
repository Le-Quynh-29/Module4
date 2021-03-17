@extends('backend.index')
@section('content')
    <div class="row">
        <div class="col-md-4 stats-info widget">
            <div class="stats-title">
                <h3>Create Productline</h3>
            </div>
            <div class="form-body">

                <form method="post" action="{{route('create_productline')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="productline" id="inputName"
                               placeholder="Productline">
                        @if($errors->any())
                            <p class="alert-danger my-sm-4">{{ $errors->first('productline') }}</p>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control" id="inputEmail" name="description"
                                  placeholder="Description"></textarea>
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
                    <th>Productline</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product_line as $key => $val)
                    <tr>
                        <th scope="row">{{$key + $product_line->firstItem()}}</th>
                        <td>
                            <a href="{{route('productline_detail', $val->id)}}}"> {{$val->productline}}</a>
                        </td>
                        <td>{{substr($val->description, 0, 100)}}...</td>
                        <td>
                            <img class="img-thumbnail img-fluid"
                                 style="width:200px !important ;height: 100px !important"
                                 src="{{ asset('images/'.$val->image) }}" alt="">
                        </td>
                        <td>
                            <a class="label label-danger" href="{{ route('delete_productline',$val->id) }}"
                               onclick="return confirm('Bạn chắc chắn muốn xóa?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="float: right;">{{ $product_line->links("pagination::bootstrap-4") }}</div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
