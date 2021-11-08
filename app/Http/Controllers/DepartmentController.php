<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data['title'] = "";
        $data['departments'] = \App\Department::paginate(10);
        return view("manager.departments.index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = "Add new department";
        return view("manager.departments.create")->with($data);
    
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

        $this->validate($request, [
            'name' => 'required',
        ]);

        $department = new \App\Department();
        $department->name = $request->input('name');
        $department->company_id = auth()->user()->company_id;
        $department->save();

        return redirect()->to('manager/departments')->with('s', 'Department added');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
        $data['title'] = "";
        $data['department'] = $department;
        $data['users'] = \App\Company::find(auth()->user()->company_id)->users()->get();
        return view("manager.departments.show")->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        $data['title'] = "Update new department";
        $data['department'] = $department;
        return view("manager.departments.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
        $this->validate($request, [
            'name' => 'required',
        ]);

        $department->name = $request->input('name');
        $department->save();

        return redirect()->to('manager/departments')->with('s', 'Department updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
