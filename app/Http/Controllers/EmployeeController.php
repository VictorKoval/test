<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\StoreEmployee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view("employee_index", ["employees" => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = new Employee();
        $companies = Company::select('id', 'name')->orderBy('name', 'ASC')->pluck('name','id');
        return view("employee_store", ["employee" => $employee, "companies" => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEmployee  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        $validated = $request->validated();
        $employee = new Employee([
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'],
            "email" => $validated['email'] ?? '',
            "phone" => $validated['phone'] ?? '',
            "company_id" => $validated['company_id']
        ]);

        $employee->save();
        return redirect(route('employee.show', array('id' => $employee->id)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = (new Employee())->where("id", $id)->first();
        return view("employee_show", ["employee" => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::select('id', 'name')->orderBy('name', 'ASC')->pluck('name','id');
        $employee = (new Employee())->where("id", $id)->first();
        return view("employee_edit", ["employee" => $employee, "companies" => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreEmployee  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployee $request, $id)
    {
        $validated = $request->validated();
        Employee::where("id", $id)->update([
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'],
            "email" => $validated['email'] ?? '',
            "phone" => $validated['phone'] ?? '',
            "company_id" => $validated['company_id']
        ]);
        return redirect(route('employee.show', array('id' => $id)));
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect(route('employee.index'));
    }
}
