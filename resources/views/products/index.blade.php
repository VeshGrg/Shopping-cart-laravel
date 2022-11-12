@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h2>Users List</h2>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Is Featured</th>
                    <th>Image</th>
                    <th>Action</th>
                    </thead>
                    {{--                    {{dd($users)}}--}}
                    @foreach($products as $i => $product_data)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$product_data->title}}</td>
                            <td>{{$product_data->price}}</td>
                            <td>{{$product_data->is_featured}}</td>
                            <td><img src="{{$product_data->image}}" alt="" width="100px"></td>
                            <td>
                                <form action="{{route('products.destroy', $product_data->id)}}" method="POST">
                                    <a href="{{ route('products.edit', $product_data->id) }}" class="btn btn-primary">Edit</a> /
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $products->withQueryString()->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!');
        setTimeout(function(){
            $('.alert').hide();
        },3000);
    </script>
@stop
