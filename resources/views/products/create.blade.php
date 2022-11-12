@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create User') }}</div>
                    @if(isset($product))
                        <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            @else
                                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @endif
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                {{ session('status') }}
                                            </div>
                                        @elseif (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <div class="col-2">Title of the Product</div>
                                            <div class="col-10">
                                                <input type="text" name="title" class="form-control" value="{{@$product->title}}" placeholder="Enter Title of the Product">
                                            </div>
                                        </div>
                                            <div class="form-group row">
                                                <div class="col-2">Price</div>
                                                <div class="col-10">
                                                    <input type="number" name="price" class="form-control" value="{{@$product->price}}" placeholder="Enter Price Here">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-2">Is Featured</div>
                                                <div class="col-10">
                                                    <input type="checkbox" name="is_featured" value="{{@$product->is_featured}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-2">Image</div>
                                                <div class="col-10">
                                                    <input type="file" name="image" class="form-control" value="{{@$product->image}}">
                                                </div>
                                            </div>
                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
