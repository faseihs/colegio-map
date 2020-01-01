@extends('layouts.app')


@section('page-title','Add Cost')




@section('content')
    <form method="POST"  enctype="multipart/form-data"
    @if (isset($cost))
        action="/cost/{{ $cost->id }}">
        @method("PUT")
    @else
        action="/cost">
    @endif

    
    
        @csrf
        <div class="form-group row">
            @include('includes.errors')
        </div>

        @php($col = \Illuminate\Support\Facades\Schema::getColumnListing('costs'))
        @foreach($col as $c)
            @if(!in_array($c,["id","created_at","updated_at"]))
                <div class="form-group row">
            
                    <div class="col-md-2 col-sm-12 text-right">
                        <label for="name">{{ \Str::title(str_replace('_',' ',$c))}}</label>
                    </div>
                    <div class="col-md-8 col-sm-12">

                        @if ($c=="start_month" || $c=="end_month")
                        @php($months=[])
                            @for ($i = 1; $i <=12; $i++)
                                @php($months[$i]=date("F", mktime(0, 0, 0, $i, 1)))
                            @endfor
                            {!! Form::select($c,$months,old($c, isset($cost) ? $cost->{$c} : null),["class"=>"form-control",'placeholder'=>"Select","required"]) !!}
                        @elseif($c=="program")
                            @php($programs=[
                                "TPM"=>"TPM",
                                "TPPM"=>"TPPM",
                                "TPMU"=>"TPMU",
                                "DPM"=>"DPM",
                                "DEI"=>"DEI",
                                "CEI"=>"CEI"
                            ])
                            {!! Form::select($c,$programs,old($c, isset($cost) ? $cost->{$c} : null),["class"=>"form-control",'placeholder'=>"Select","required"]) !!}

                        @elseif($c=="type")
                                {!! Form::select($c,["A"=>"A","B"=>"B"],old($c, isset($cost) ? $cost->{$c} : null),["class"=>"form-control",'placeholder'=>"Select","required"]) !!}
                            </select>
                        @else 
                            <input required  name="{{ $c }}" class="form-control" type="number" step="any"  value="{{{ old($c, isset($cost) ? $cost->{$c} : null) }}}" required>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
       

        <div class="form-group row">
            <div class="col-md-12 text-center">
                <button class="btn btn-outline-success"><i class="ion-ios-checkmark"></i> Save</button>
            </div>
        </div>

    </form>


@endsection
