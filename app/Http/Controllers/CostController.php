<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cost;
use App\Model\StudentPlan;

class CostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:Super Admin|Admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $costs=Cost::orderBy('program')->orderBy('type')->get();
        return view('cost.index',compact('costs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cost.add-edit');
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

        $rules=[];
        $col = \Illuminate\Support\Facades\Schema::getColumnListing('costs');
        foreach($col as $c){
            if(!in_array($c,["id","created_at","updated_at"]))
                $rules[$c]="required";
        }

        $this->validate($request,$rules);

        $cost= new Cost($request->all());
        $cost->save();
        return redirect('/cost')->with('success','Successfully Added Costs');
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
        $cost=Cost::findOrFail($id);
        return view('cost.add-edit',compact('cost'));
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
        $cost= Cost::findOrFail($id);
        $rules=[];
        $col = \Illuminate\Support\Facades\Schema::getColumnListing('costs');
        foreach($col as $c){
            if(!in_array($c,["id","created_at","updated_at"]))
                $rules[$c]="required";
        }

        $this->validate($request,$rules);
        $cost->update($request->all());
        return redirect('/cost')->with('success','Successfully Added Costs');
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

        $cost= Cost::findOrFail($id);
        $plan = StudentPlan::where('cost_id',$id)->first();
        if($plan)
            return redirect("/cost")->with('danger',"Cannot Delete Cost. Student Plan already exists for related to this cost");
        else {
            $cost->delete();
            return redirect('/cost')->with('success','Successfully Deleted Costs');
        }
    }
}
