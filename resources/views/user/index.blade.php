@extends('layouts.app')


@section('page-title','Users')
@section(($type=="User"?"u-active":'admin-active'),'active')




@section('content')
    <div class="row">
        @include('includes.flash')



    </div>
    <div style="margin-top: 4px;" class="row">
        <div class="col-md-10 offset-1 table-responsive">
            <div class="card">
                <div class="card-header">Users
                    @role('Super Admin')
                        <a class="btn btn-success float-right" href="/add-admin"><i class="ion-ios-plus"></i> Add Admin</a>
                    @endrole
                </div>
                <div class="card-body">
                    @if(sizeof($users)>0)
                        <table class="table table-hover">
                            <thead>
                            <tr>

                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                                    @role('Super Admin')
                                <th></th>
                                    @endrole

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $a)
                                <tr>
                                    <td><a href="/user/{{$a->id}}">{{$a->name}}</a></td>
                                    <td>{{$a->email}}</td>
                                    <td>{{ $a->getRoleNames() }}</td>
                                    <td>{{Carbon::parse($a->created_at)->diffForHumans()}}</td>

                                        @role('Super Admin')
                                    <td>
                                        <a onclick="clicked({{$a->id}})" href="#"><i class="fa fa-trash"></i></a>
                                        <form method="POST" id="del{{$a->id}}" action="/admin/delete-admin/{{$a->id}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                        @endrole

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning">No Users...</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function clicked(id){
            if(confirm("Are You Sure ?")){
                document.getElementById('del'+id).submit();
            }
            else{
            }
        }
    </script>
@endsection
