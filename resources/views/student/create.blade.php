@extends('layouts.app')
@section('title','| Add Student')
@section('content')
    <form action="/student" method="POST">
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
                                    <input type="text" name="id" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">{{__("Name")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Last Name")}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">{{__("Group")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="group" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">{{__("DOB")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="date" type="date" name="dob" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">{{__("Age")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="age" type="number" name="age" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">{{__("Program")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="program" class="form-control">
                                        <option>Select</option>
                                        <option value="TPM">TPM</option>
                                        <option value="TPM">TPPM</option>
                                        <option value="TPMU">TPMU</option>
                                        <option value="DPM">DPM</option>
                                        <option value="DEI">DEI</option>
                                        <option value="CEI">CEI</option>
                                    </select>
                                   {{-- <input type="text" name="program" class="form-control">--}}
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">{{__("Clasroom Number")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="classroom_number" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="age">{{__("Semester")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="semester" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">{{__("Date of admission")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="date_of_admission" class="form-control">
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
                    <div class="card-header">{{__("Document Details")}}</div>

                    <div class="card-body">

                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Birth Certificate")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="birth_certificate" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("CURP")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="curp" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("High School Certificate")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="high_school_certificate" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Home Address")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="home_address" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Photos")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="photos" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Official ID")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="official_id" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Insurance")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="insurance" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("AES")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="aes" class="form-control">
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{__("Contact Details")}}</div>

                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Phone Number")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="phone_number" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Email")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Emergency Contact")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="emergency_contact" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Observations")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="observations" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Signed Contract")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="signed_contract" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Payment Plan")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="payment_plan" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("SEP")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="sep" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 text-right">
                                <label for="name">{{__("Tutor")}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="tutor" class="form-control">
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


@section('scripts')
    <script>
        $(document).ready(function () {
            $('#date').change(function () {
                let val = $(this).val();
                if(val.length>1){
                    let age =calculate_age(new Date(val));
                    if(age<100)
                        $('#age').val(age);
                }
            })
        });

        function calculate_age(dob) {
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);

            return Math.abs(age_dt.getUTCFullYear() - 1970);
        }
    </script>
@endsection
