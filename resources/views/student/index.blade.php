@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
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
                                   <table style="width:100%" class="table table-sm" id="user-datatable">
                                       <thead>
                                       <tr>
                                         {{--  @foreach($students->first()->getAttributes() as $index =>$s)
                                               @if($index=="id")
                                                   <th>Student ID</th>
                                                   @else
                                                   <th>{{ucfirst(str_replace('_', ' ', $index))}}</th>
                                               @endif

                                           @endforeach--}}
                                            <th>{{__('Student ID')}}</th>
                                           <th>{{__('Name')}}</th>
                                           <th>{{__('Last Name')}}</th>
                                         {{--  <th>{{__('Group')}}</th>
                                           <th>{{__('DOB')}}</th>
                                           <th>{{__('Age')}}</th>--}}
                                           <th>{{__('Program')}}</th>
                                         {{--  <th>Classroom</th>
                                           <th>{{__('Semester')}}</th>
                                           <th>{{__('Date of admission')}}</th>--}}
                                           <th>{{__("Phone Number")}}</th>
                                           <th>{{__("Tutor")}}</th>
                                           <th>{{__("Emergency Contact")}}</th>
                                           <th>{{__("Created At")}}</th>
                                           <th>Actions</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($students as $student)
                                           <tr>
                                              {{-- @foreach($student->getAttributes() as $index =>$s)
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
                                               </td>--}}
                                           </tr>

                                       @endforeach
                                       </tbody>


                                   </table>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('styles')
    <link rel="stylesheet" href="/css/datatables.min.css">
@endsection
@section('scripts')

    <script src="/js/datatables.min.js"></script>
    @if(sizeof($students)>0)
        @include('includes.delete')
    @endif

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var $datatable = $('#user-datatable');
        var table = $datatable.DataTable({
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "last_name"},
             /*   {"data": "group"},
                {"data": "dob"},
                {"data": "age"},*/
                {"data": "program"},
             /*   {"data": "classroom_number"},
                {"data": "semester"},
                {"data": "date_of_admission"},*/
                {"data":"contact",render:function (contact) {
                        return contact?contact.phone_number:'-'
                    }},
                {"data":"contact",render:function (contact) {
                        return contact?contact.tutor:'-'
                    }},
                {"data":"contact",render:function (contact) {
                        return contact?contact.emergency_contact:'-'
                    }},
                {"data": "created_at"},
                {"data":"id",render:function (id,row,data) {

                    let s =``;
                         if(data.deleted_at)
                            s+=`<a class="btn btn-success btn-sm" href="/student/${id}/restore">Restore</a>`;

                        if(!data.deleted_at)
                            s+=`<a class="btn btn-sm btn-primary" href="/student/${id}/edit">View/Edit</a>`;

                            s+=`<a class="btn btn-sm btn-danger ml-2" onclick="deleteObj(${id})" href="#">Delete</a>
                            <form method="POST" id="del${id}" action="/student/${id}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            </form>`;
                            return s;
                    }},
            ],
            'processing': true,
            'stateSave': false,
            'serverSide': true,
            'ajax': {
                'url': '{{$type=="deleted"?"student-data-trashed":"student-data"}}',
                'type': 'POST'
            },
            'order': [[ 0, 'desc' ]],
            'columnDefs': [
                { "orderable": false, "targets": [-1] },
                { "searchable": false, "targets": [-1] }
            ]
        });
        $( table.table().container() ).removeClass( 'form-inline' );

        $('#user-datatable_processing').html(`<div class="text-center m-4">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>`)
    </script>
@endsection
