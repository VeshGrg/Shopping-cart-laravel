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
                    @if(isset($user))
                        <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                    @else
                        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-2">Name</div>
                                    <div class="col-10">
                                        <input type="text" name="name" class="form-control" value="{{@$user->name}}" placeholder="Enter New Name">
                                    </div>
                                </div>
                                @if(isset($user))
                                @else
                                    <div class="form-group row">
                                        <div class="col-2">Email</div>
                                        <div class="col-10">
                                            <input type="email" name="email" class="form-control" value="{{@$user->email}}" placeholder="Enter Email Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-2">Password</div>
                                        <div class="col-10">
                                            <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-2">Retype Password</div>
                                        <div class="col-10">
                                            <input type="password" name="password" class="form-control" placeholder="Enter Your Password Again">
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <div class="col-2">Address</div>
                                    <div class="col-10">
                                        <input type="text" name="address" class="form-control" value="{{@$user->address}}" placeholder="Enter Address Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-2">Contact No.</div>
                                    <div class="col-10">
                                        <input type="text" name="phone" class="form-control" value="{{@$user->phone}}" placeholder="Enter Contact No.">
                                    </div>
                                </div>
                                    <div class="form-group row">
                                        <div class="col-2">Image</div>
                                        <div class="col-10">
                                            <input type="file" name="image" class="form-control" value="{{@$user->image}}">
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
