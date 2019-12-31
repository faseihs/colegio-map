<?php

namespace App\Http\Controllers;

use App\Model\Cost;
use App\Model\Payment;
use App\Model\Student;
use App\Model\StudentPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    //

    public function index($id){
        $student=Student::findOrFail($id);
        $user=Auth::user();
        $plans=$student->plans;
        foreach ($plans as $plan) {
            $months=6;
            if($plan->type=="A")
                $months=6;
            else $months=5;
            $subject_fee_semester=$plan->subject_fee_semester/$months;
            $additonal_subject_fee_semester=$plan->additonal_subject_fee_semester/6;
            $extra_curricular_subject_fee_month=$plan->extra_curricular_subject_fee_month;
            $cost_extra_materials=$plan->cost_extra_materials;

            $total_monthly_cost=($subject_fee_semester*$plan->num_subjects) +
                ($additonal_subject_fee_semester*$plan->num_extra_subjects) +
                ($extra_curricular_subject_fee_month * $plan->num_extra) +
                $cost_extra_materials;

            $total_semester_cost = $total_monthly_cost*6;

            $subject_fee_semester=round($subject_fee_semester/100)*100;
            //dd(floor($subject_fee_semester/100)*100);
            $plan->subject_fee_month =$subject_fee_semester;
            $plan->total_monthly_cost=round($total_monthly_cost/100)*100;
            $plan->total_semester_cost=$total_semester_cost;

        }
        $payments=$student->payments;
        $costs =Cost::all();
        return view("payments.index",compact('user','plans','payments','costs','id'));
    }


    public function create($id,Request $request){
        $student = Student::findOrFail($id);
        $cost = Cost::findOrFail($request->cost_id);
        $this->validate($request,[
           'program'=>'required',
            'cost_id'=>'required|numeric',
            'type'=>'required',
            'subject_fee_semester'=>'numeric|min:0',
            'additional_subject_fee_semester'=>'numeric|min:0',
            'extra_curricular_subject_fee_month'=>'numeric|min:0',
            'num_subjects'=>'numeric|gte:'.$cost->min_subjects.'|lte:'.$cost->max_subjects,
            'num_extra_subjects'=>'numeric|min:0',
            'num_extra'=>'numeric|min:0',
            'reg_fee'=>'numeric|min:0',
            're_reg_fee'=>'numeric|min:0',
            'cost_extra_materials'=>'numeric|min:0',
        ]);

        $plan = StudentPlan::where('cost_id',$cost->id)->where('student_id',$student->id)->first();
        if($plan){
            $plan->update($request->except(
                '_token','type','program','cost_id','student_id'
            ));
        }
        else {
            $plan = new StudentPlan($request->except(
                '_token','type','program'
            ));
            $plan->save();
        }

        return Redirect::back()->with('success','Added Payment Plan');

    }


    public function createReceipt(Request $request,$id){

        $this->validate($request,[
           'date'=>'required|date',
           'amount'=>'required|numeric',
           'description'=>'nullable',
            'payment_mode'=>'required',
            'payment_type'=>'required'
        ]);
        $student = Student::findOrFail($id);
        $date=Carbon::parse($request->date);
        $amount=$request->amount;
        $payment_mode=$request->payment_mode;
        $payment_type=$request->payment_type;
        $desc=$request->description;
        $year=$date->year;
        $month=$date->month;

        $payment= new Payment();
        $payment->student_id=$id;
        $payment->year=$year;
        $payment->month=$month;
        $payment->payment_mode=$request->payment_mode;
        $payment->payment_type=$request->payment_type;
        $payment->description=$request->description;
        $payment->amount=$request->amount;
        $payment->save();

        return Redirect::back()->with('success','Payment Receipt Added');


    }
}
