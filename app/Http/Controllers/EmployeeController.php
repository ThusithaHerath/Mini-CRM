<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::paginate(10);
        return view('admin.employee.index',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        return view('admin.employee.addemployee',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|unique:employees,email',
            'phone'=>'required|numeric|digits:10',
           
        ],
        [
            'fname.required' => 'first name is required',
            'lname.required' => 'last name is required',
            'email.required' => 'email is required',
            'email.unique' => 'this email is already exist',
            'phone.required' => 'phone  is required',
            'phone.unique' => 'this phone number is already exist',
        ]
    
    );
        $data = new Employee;
        $data->firstname = $request->input('fname');
        $data->lastname = $request->input('lname');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->company_id = $request->input('company');

        $data->save();

        Session::flash('employee_added','Employee added successfully.');

        return redirect('/manage-employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee,$id)
    {
        $employee = Employee::findOrFail($id);
        $company = Company::all();

        return view('admin.employee.editemployee',compact('employee','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Employee::findOrFail($id);

        $data->firstname = $request->input('fname');
        $data->lastname = $request->input('lname');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->company_id = $request->input('company');


        $data->save();

        Session::flash('employee_updated','The Employee has been successfully Updated.');

        return redirect('/manage-employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee,$id)
    {
        $data = Employee::findOrFail($id);
        $data->delete();
 
        Session::flash('deleted_employee','The employee has been successfully Deleted.');
        return redirect('/manage-employee');
    }
}
