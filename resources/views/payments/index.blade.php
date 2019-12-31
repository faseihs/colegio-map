@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">Payment Plans
                        <div class="float-right">
                            <a href="/student" class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-left"></i>
                                 Go Back
                            </a>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Add Payment Plan</button>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('includes.flash')
                        @include('includes.errors')
                        <div class="row">
                            <div class="col-12 table-responsive">
                                @if(sizeof($plans)>0)
                                <table class="table table-sm" id="user-datatable">
                                    <thead>
                                    <tr>
                                        <th>Program</th>
                                        <th>Semester</th>
                                        <th>Num Subjects</th>
                                        <th>Cost Per Subject</th>
                                        <th>Monthly Cost Per Subject</th>
                                        <th>Cost Extra Materials Per Month</th>
                                        <th>Total Monthly Fee</th>
                                        <th>Total Semester Fee</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($plans as $p)
                                        <tr>
                                            <td>{{$p->cost->program}}</td>
                                            <td>{{$p->cost->type}}</td>
                                            <td>{{$p->num_subjects}}</td>
                                            <td>{{$p->subject_fee_semester}}</td>
                                            <td>{{$p->subject_fee_month}}</td>
                                            <td>{{$p->cost_extra_materials}}</td>
                                            <td>{{$p->total_monthly_cost}}</td>
                                            <td>{{$p->total_semester_cost}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                    @else
                                    <div class="alert alert-warning">No Plans...</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-md-12 m-4">
               <div class="card">
                   <div class="card-header">Payments
                   </div>
                   <div class="card-body">
                       <div class="row">
                           <div class="col-md-2 text-center">
                               <h1>A</h1>
                           </div>
                           <div class="col-md-8">
                               <div class="row">
                                   @for($i=1;$i<=6;$i++)
                                   <div class="col-md-2 border border-dark pb-4 pt-4 text-center">
                                       {{date("F", mktime(0, 0, 0, $i, 1))}}
                                   </div>
                                   @endfor
                               </div>
                           </div>
                           <div class="col-md-2">
                               <button data-toggle="modal" data-target="#paymentModal" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i></button>
                           </div>
                       </div>

                       <div class="row">
                           <div class="col-md-2 text-center">
                               <h1>B</h1>
                           </div>
                           <div class="col-md-8">
                               <div class="row">
                                   @for($i=8;$i<=12;$i++)
                                       <div class="col-md-2 border border-dark pb-4 pt-4 text-center">
                                           {{date("F", mktime(0, 0, 0, $i, 1))}}
                                       </div>
                                   @endfor
                               </div>
                           </div>
                       </div>
                       <div class="row mt-4">
                           <div class="col-md-12 table-responsive">
                               @if(sizeof($payments)>0)
                                   <table class="table table-hover table-sm">
                                       <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Amount</th>
                                            <th>Payment Type</th>
                                            <th>Payment Mode</th>
                                            <th>Created At</th>
                                        </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($payments as $p)
                                           <tr>
                                               <td>{{$p->id}}</td>
                                               <td> {{date("F", mktime(0, 0, 0, $p->month, 1))}}</td>
                                               <td>{{$p->year}}</td>
                                               <td>{{$p->amount}}</td>
                                               <td>{{ucfirst($p->payment_type)}}</td>
                                               <td>{{ucfirst($p->payment_mode)}}</td>
                                               <td>{{$p->created_at}}</td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               @else
                                   <div class="alert alert-warning">No Payments...</div>
                               @endif
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
   <div class="modal" id="paymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/student/{{$id}}/receipt/create" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" step="any" name="amount" class="form-control" placeholder="Amount To Pay" required>
                    </div>
                </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <select name="payment_type" class="form-control" required>
                                <option>Payment Type</option>
                                <option value="monthly_fee">Monthly</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="payment_mode" class="form-control" required>
                                <option>Payment Mode</option>
                                <option value="cash">Cash</option>
                                <option value="deposit">Deposit</option>
                                <option value="transfer">Transfer</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <textarea class="form-control" name="description" rows="10"></textarea>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
   </div>

    <!-- Costs Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chose Payment Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Num Subjects</th>
                                    <th>Num Extracurricular</th>
                                    <th>Num Additional Subjects</th>
                                    <th>Cost Extra Materials</th>
                                   @php($col = \Illuminate\Support\Facades\Schema::getColumnListing('costs'))
                                    @foreach($col as $c)
                                        @if(!in_array($c,["id","created_at","updated_at","min_subjects","max_subjects"]))
                                            <th>{{$c}}</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($costs as $c)
                                    <tr>
                                        <form method="POST" action="/student/{{$id}}/payment/create">
                                            @csrf
                                            <input id="planId" type="hidden" name="cost_id" value="{{$c->id}}">
                                            <input id="planId" type="hidden" name="student_id" value="{{$id}}">
                                        <td><button onclick="selectPlan({{$c->id}})" class="btn btn-success btn-sm">Add</button></td>
                                            <td><input value="0" name="num_subjects" class="form-control form-control-sm" style="min-width: 50px;max-width: 100px;" type="text"></td>
                                            <td><input value="0" name="num_extra" class="form-control form-control-sm" style="min-width: 50px;max-width: 100px;" type="text"></td>
                                            <td><input value="0" name="num_extra_subjects" class="form-control form-control-sm" style="min-width: 50px;max-width: 100px;" type="text"></td>
                                            <td><input value="0" name="cost_extra_materials" class="form-control form-control-sm" style="min-width: 50px;max-width: 100px;" type="text"></td>

                                        @foreach(\Illuminate\Support\Facades\Schema::getColumnListing('costs') as $i)
                                            @if(!in_array($i,["id","created_at","updated_at","min_subjects","max_subjects"]))
                                                    <td> <input class="form-control form-control-sm" style="min-width: 50px;max-width: 100px;" type="text" name="{{$i}}" value="{{  $c->{$i}  }}"> </td>
                                            @endif

                                        @endforeach
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="POST" id="planForm" class="d-none" action="/student/{{$id}}/payment/create">
                            @csrf
                            <input id="planId" type="hidden" name="plan_id">
                        </form>
                    </div>
                </div>
               {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>--}}
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="/css/datatables.min.css">
@endsection
@section('scripts')
    <script src="/js/datatables.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function selectPlan(id) {
            $('#planId').val(id);
            $('#planForm').submit();
        }
    </script>
@endsection
