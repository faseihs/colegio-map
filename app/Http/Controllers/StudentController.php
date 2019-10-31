<?php

namespace App\Http\Controllers;

use App\Model\Contact;
use App\Model\Document;
use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $type="current";
        if($request->has('type'))
            $type=$request->type;

        if($type=="current")
            $students=Student::orderBy('name')->paginate(10);
        else $students=Student::onlyTrashed()->paginate(10);
        return  view('student.index',compact('students','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'id'=>'required|unique:students',
            'name'=>'required',
            'group'=>'required',
        ]);

        try{
            DB::beginTransaction();

            $studentDetails=[];
            $studentDetails["id"]=$request["id"];
            $studentDetails["name"]=$request["name"];
            $studentDetails["group"]=$request["group"];
            $studentDetails["dob"]=$request["dob"];
            $studentDetails["age"]=$request["age"];
            $studentDetails["program"]=$request["program"];
            $studentDetails["classroom_number"]=$request["classroom_number"];
            $studentDetails["semester"]=$request["semester"];
            $studentDetails["date_of_admission"]=$request["date_of_admission"];
            $student=Student::create($studentDetails);


            $contactDetails=['student_id'=>$student->id];
            $contactDetails["phone_number"]=$request["phone_number"];
            $contactDetails["email"]=$request["email"];
            $contactDetails["emergency_contact"]=$request["emergency_contact"];
            $contactDetails["observations"]=$request["observations"];
            $contactDetails["signed_contract"]=$request["signed_contract"];
            $contactDetails["payment_plan"]=$request["payment_plan"];
            $contactDetails["sep"]=$request["sep"];
            $contact=Contact::create($contactDetails);

            $documentDetails=['student_id'=>$student->id];
            $documentDetails["curp"]=$request["curp"];
            $documentDetails["birth_certificate"]=$request["birth_certificate"];
            $documentDetails["high_school_certificate"]=$request["high_school_certificate"];
            $documentDetails["home_address"]=$request["home_address"];
            $documentDetails["photos"]=$request["photos"];
            $documentDetails["official_id"]=$request["official_id"];
            $documentDetails["insurance"]=$request["insurance"];
            $documentDetails["aes"]=$request["aes"];
            $document=Document::create($documentDetails);
            DB::commit();
            return redirect('/student')->with('success','Added Successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            if(env('APP_ENV')=="local")
                dd($e);
            else abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student=Student::findOrFail($id);
        $document=$student->document;
        $contact=$student->contact;
        return view('student.edit',compact('student','document','contact'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $student=Student::findOrFail($id);
        $contact=$student->contact;
        $document=$student->document;
        $this->validate($request,[
            'id'=>'required|unique:students,id,'.$student->id,
            'name'=>'required',
            'group'=>'required',
        ]);

        try{
            DB::beginTransaction();

            $studentDetails=[];
            $studentDetails["id"]=$request["id"];
            $studentDetails["name"]=$request["name"];
            $studentDetails["group"]=$request["group"];
            $studentDetails["dob"]=$request["dob"];
            $studentDetails["age"]=$request["age"];
            $studentDetails["program"]=$request["program"];
            $studentDetails["classroom_number"]=$request["classroom_number"];
            $studentDetails["semester"]=$request["semester"];
            $studentDetails["date_of_admission"]=$request["date_of_admission"];
            $student->update($studentDetails);



            $contactDetails["phone_number"]=$request["phone_number"];
            $contactDetails["email"]=$request["email"];
            $contactDetails["emergency_contact"]=$request["emergency_contact"];
            $contactDetails["observations"]=$request["observations"];
            $contactDetails["signed_contract"]=$request["signed_contract"];
            $contactDetails["payment_plan"]=$request["payment_plan"];
            $contactDetails["sep"]=$request["sep"];
            $contact->update($contactDetails);


            $documentDetails["curp"]=$request["curp"];
            $documentDetails["birth_certificate"]=$request["birth_certificate"];
            $documentDetails["high_school_certificate"]=$request["high_school_certificate"];
            $documentDetails["home_address"]=$request["home_address"];
            $documentDetails["photos"]=$request["photos"];
            $documentDetails["official_id"]=$request["official_id"];
            $documentDetails["insurance"]=$request["insurance"];
            $documentDetails["aes"]=$request["aes"];
            $document->update($documentDetails);
            DB::commit();
            return redirect('/student/'.$id.'/edit')->with('success','Updated Successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            if(env('APP_ENV')=="local")
                dd($e);
            else abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $student=Student::withTrashed()->where('id',$id)->first();
        if(!$student)
            abort(404);

        if($student->deleted_at){
            $student->forceDelete();
        }
        else $student->delete();
        return  redirect('/student')->with('success','Deleted Successfully');
    }

    public function restore($id){
        $student=Student::onlyTrashed()->where('id',$id)->first();
        if(!$student)
            abort(404);
        $student->restore();
        return  redirect('/student')->with('success','Restored Successfully');
    }
}
