@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-ld-10 col-xl-10 col-sm-12">
                <div class="card">
                    <div class="card-header">Students
                        <div class="float-right">
                            <select onchange="window.location='/student?type='+this.value" class="form-control-sm">
                                <option {{$type=="current"?'selected':''}}  value="current">Current</option>
                                <option {{$type=="deleted"?'selected':''}} value="deleted">Deleted</option>
                            </select>
                            <a class="btn btn-success btn-sm" href="/student/create">Add Student</a></div>
                        </div>


                    <div class="card-body">
                      @include('includes.flash')

                       <div class="row">
                           <div class="col-12 table-responsive">
                               @if(sizeof($students)>0)
                                   <table class="table">
                                       <thead>
                                       <tr>
                                           @foreach($students->first()->getAttributes() as $index =>$s)
                                               @if($index=="id")
                                                   <th>Student ID</th>
                                                   @else
                                                   <th>{{ucfirst(str_replace('_', ' ', $index))}}</th>
                                               @endif

                                           @endforeach
                                           <th>Actions</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($students as $student)
                                           <tr>
                                               @foreach($student->getAttributes() as $index =>$s)
                                                   <td>{{$s}}</td>
                                               @endforeach
                                               <td>
                                                   @if($student->deleted_at)
                                                       <a class="btn btn-success btn-sm" href="/student/{{$student->id}}/restore">Restore</a>
                                                   @endif
                                                       @if(!$student->deleted_at)
                                                        <a class="btn btn-sm btn-primary" href="/student/{{$student->id}}/edit">View/Edit</a>
                                                       @endif
                                                   <a class="btn btn-sm btn-danger" onclick="deleteObj({{$student->id}})" href="#">Delete</a>
                                                   <form method="POST" id="del{{$student->id}}" action="/student/{{$student->id}}">
                                                       @csrf
                                                       <input type="hidden" name="_method" value="DELETE">
                                                   </form>
                                               </td>
                                           </tr>

                                       @endforeach
                                       </tbody>


                                   </table>
                                   {!! $students->appends(Request::input())->links() !!}
                                   @else
                                    <div class="alert alert-warning">No Students...</div>
                               @endif
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @if(sizeof($students)>0)
        @include('includes.delete')
    @endif
@endsection
