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
                    <div class="card-header">{{ __('Change Profile') }}</div>
                    @foreach($user as $user_data)
                    <form action="{{route('update-profile', $user_data->id)}}" method="POST">
                        @csrf
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
                                    <input type="text" name="name" class="form-control" placeholder="Enter New Name" value="{{$user_data->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2">Address</div>
                                <div class="col-10">
                                    <input type="text" name="address" class="form-control" placeholder="Enter New Address" value="{{$user_data->address}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2">Contact No.</div>
                                <div class="col-10">
                                    <input type="text" name="phone" class="form-control" placeholder="Enter New Contact Detail" value="{{$user_data->phone}}">
                                </div>
                            </div>


                        </div>

                        <div class="card-footer">
                            <button class="btn btn-success">Submit</button>
                        </div>

                    </form>
                        @endforeach
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
