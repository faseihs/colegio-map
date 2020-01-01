@extends('layouts.app')
@section('page-title',"Costs")
@section('content')
    <div class="row">
       
       
    </div>
    <div style="margin-top: 4px;" class="row">
        <div class="col-md-12  table-responsive">
            <div class="card">
                <div class="card-header">Costs
                    <div class="float-right">
                        <a class="btn btn-success btn-sm" href="/cost/create"><i class="fa fa-plus"></i> Add Costs</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12 table-responsive">
                        @include('includes.flash')
                    @if(sizeof($costs)>0)
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                @php($col = \Illuminate\Support\Facades\Schema::getColumnListing('costs'))
                                @foreach($col as $c)
                                    @if(!in_array($c,["id","created_at","updated_at"]))
                                        <th>{{  \Str::title(str_replace('_',' ',$c))}}</th>
                                    @endif
                                   
                                @endforeach
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($costs as $cost)
                                <tr>
                                    @foreach($col as $c)
                                        @if(!in_array($c,["id","created_at","updated_at"]))
                                            @if ($c=="start_month" || $c=="end_month")
                                                <td>{{date("F", mktime(0, 0, 0, $cost->{$c}, 1))}}</td>
                                                @else 
                                                <td>{{ $cost->{$c} }}</td>
                                            @endif
                                            
                                        @endif
                                    @endforeach
                                    <td>
                                        <a class="btn btn-info btn-sm text-white" href="/cost/{{ $cost->id }}/edit">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning">No Costs...</div>
                    @endif
                </div>
            </div>
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
