<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class EmployeeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        return $this->user->employees()->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = $this->createOrUpdate($this->user->employees()->make(), $request);
        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Employee::findOrFail($id);
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
        $employee = $this->createOrUpdate($this->user->employees()->findOrNew($id), $request);
        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'message' => '[Employee '. $employee->role .' of User '. $employee->user->name .'] Successfully deleted.'
        ]);
    }

    private function createOrUpdate(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'role' => 'required',
            'division' => 'required',
            'hourly_rate' => 'required',
            'contract' => 'required',
            'start_at' => 'required|date_format:Y-m-d H:i:s',
            'job_status' => 'required',
            'job_status_description' => 'required',
        ]);

        $employee->fill($request->all());
        $employee->save();

        return $employee;
    }
}
