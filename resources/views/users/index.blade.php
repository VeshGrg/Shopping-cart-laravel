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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Action</th>
                    </thead>
{{--                    {{dd($users)}}--}}
                    @foreach($users as $i => $user_data)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$user_data->name}}</td>
                        <td>{{$user_data->address}}</td>
                        <td>{{$user_data->phone}}</td>
                        <td>{{$user_data->email}}</td>
                        <td><img src="/images/{{ $user_data->image }}" width="100px"></td>
                        <td>
                            <form action="{{route('users.destroy', $user_data->id)}}" method="POST">
                            <a href="{{ route('users.edit', $user_data->id) }}" class="btn btn-primary">Edit</a> /
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
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
