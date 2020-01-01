@extends('layouts.app')


@section('page-title','Add Admin')
@section('admin-active','active')



@section('content')
    <form method="POST" action="/add-admin" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            @include('includes.errors')
            <div class="col-md-1 col-sm-12 text-right">
                <label for="name">Name</label>
            </div>
            <div class="col-md-11 col-sm-12">
                <input required name="name" class="form-control" type="text">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-1 col-sm-12 text-right">
                <label for="name">Email</label>
            </div>
            <div class="col-md-11 col-sm-12">
                <input required name="email" class="form-control" type="email">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-1 col-sm-12 text-right">
                <label for="name">Password</label>
            </div>
            <div class="col-md-11 col-sm-12">
                <input required name="password" class="form-control" type="password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-1 col-sm-12 text-right">
                <label for="name">Confirm Password</label>
            </div>
            <div class="col-md-11 col-sm-12">
                <input required name="password_confirmation" class="form-control" type="password">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-1 col-sm-12 text-right">
                <label for="name">Role</label>
            </div>
            <div class="col-md-11 col-sm-12">
                @php($options=["class"=>"form-control",'placeholder'=>"Select","required"])

                {!! Form::select("role",$roles,null,$options) !!}
            
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12 text-center">
                <button class="btn btn-outline-success"><i class="ion-ios-checkmark"></i> Save</button>
            </div>
        </div>

    </form>


@endsection
