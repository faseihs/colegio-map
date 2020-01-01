@extends('layouts.app')


@section('page-title',$user->name)
@section('u-active','active')



@section('content')

    <form method="POST" action="/user/{{$user->id}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                @include('includes.errors')
                @include('includes.flash')
            </div>
        </div>
        <div class="form-group row">
           
            <div class="col-md-2 col-sm-12 text-right">
                <label for="name">Name</label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input value="{{$user->name}}" required name="name" class="form-control" type="text">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-2 col-sm-12 text-right">
                <label for="name">Email</label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input autocomplete="none" value="{{$user->email}}" required name="email" class="form-control" type="email">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-2 col-sm-12 text-right">
                <label for="name">Role</label>
            </div>
            <div class="col-md-8 col-sm-12">
                @php($options=["class"=>"form-control",'placeholder'=>"Select","required"])
                @if ($user->hasrole("Super Admin"))
                    @php($options[]="readonly")
                @endif
                {!! Form::select("role",$roles,$role,$options) !!}
        
            </div>
        </div>
        <hr>

        <div class="form-group row">

            <div class="col-md-2 col-sm-12 text-right">
                <label for="name">New Password</label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input autocomplete="off"  name="password" class="form-control" type="password">
                <small>Enter in the password fields only if you want to change password</small>
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-2 col-sm-12 text-right">
                <label for="name">Confirm Password</label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input autocomplete="off"  name="password_confirmation" class="form-control" type="password">
            </div>
        </div>


        <div class="form-group row">
            <div class="col-md-12 text-center">
                <button class="btn btn-outline-success"><i class="ion-ios-checkmark"></i> Save</button>
            </div>
        </div>

    </form>
@endsection

