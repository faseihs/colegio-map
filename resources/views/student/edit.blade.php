@extends('layouts.app')
@section('title','| Edit Student '.$student->id)
@section('content')
    <form action="/student/{{$student->id}}" method="POST">
        <input type="hidden" value="PUT" name="_method">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-10 col-xl-10 col-sm-12">
                    <div class="card">
                        <div class="card-header">Student Details</div>
                        @include('includes.flash')
                        @include('includes.errors')
                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Student ID</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="id" class="form-control" required value="{{$student->id}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" required value="{{$student->name}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Group</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="group" class="form-control" required value="{{$student->group}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Date Of Birth</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="dob" class="form-control" value="{{$student->dob}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">Age</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="age" class="form-control" value="{{$student->age}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">Program</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="program" class="form-control" value="{{$student->program}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">Classroom #</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="classroom_number" class="form-control"  value="{{$student->classroom_number}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">Semester</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="semester" class="form-control"  value="{{$student->semester}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Date Of Admission</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="date_of_admission" class="form-control" value="{{$student->date_of_admission}}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Document Details</div>

                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Birth Certificate</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="birth_certificate" class="form-control"  value="{{$document->birth_certificate}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">CURP</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="curp" class="form-control" value="{{$document->curp}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">High School Certificate</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="high_school_certificate" class="form-control"  value="{{$document->high_school_certificate}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Home_address</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="home_address" class="form-control"  value="{{$document->home_address}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Photos</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="photos" class="form-control" value="{{$document->photos}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Official ID</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="official_id" class="form-control" value="{{$document->official_id}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Insurance</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="insurance" class="form-control" value="{{$document->insurance}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">AES</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="aes" class="form-control" value="{{$document->aes}}">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Contact Details</div>

                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Phone Number</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="phone_number" class="form-control" value="{{$contact->phone_number}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Email</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="email" name="email" class="form-control" value="{{$contact->email}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Emergency Contact</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="emergency_contact" class="form-control" value="{{$contact->emergency_contact}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Observations</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="observations" class="form-control" value="{{$contact->observations}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Signed Contract</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="signed_contract" class="form-control" value="{{$contact->signed_contract}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Payment Plan</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="payment_plan" class="form-control" value="{{$contact->payment_plan}}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">SEP</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="sep" class="form-control"  value="{{$contact->sep}}">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <button class="btn btn-success btn-block">Save</button>
                </div>
            </div>
        </div>


    </form>
@endsection
