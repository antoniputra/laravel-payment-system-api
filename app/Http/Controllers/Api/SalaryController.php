<?php

namespace App\Http\Controllers\Api;

use App\Salary;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class SalaryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $employeeId
     * @return \Illuminate\Http\Response
     */
    public function index($employeeId)
    {
        $perPage = request('per_page', 10);
        return Salary::byEmployee($employeeId)->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $employeeId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, Request $request)
    {
        $employee = Employee::findOrFail($employeeId);
        $salary = $this->createOrUpdate($employee->salaries()->make(), $request);
        return response()->json($salary, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $employeeId
     * @param  int  $salaryId
     * @return \Illuminate\Http\Response
     */
    public function show($employeeId, $salaryId)
    {
        return Salary::byEmployee($employeeId)->findOrFail($salaryId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $employeeId
     * @param  int  $salaryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employeeId, $salaryId)
    {
        $employee = Employee::findOrFail($employeeId);
        $salary = $this->createOrUpdate($employee->salaries()->findOrNew($salaryId), $request);
        return response()->json($salary, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $employeeId
     * @param  int  $salaryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId, $salaryId)
    {
        $salary = Salary::byEmployee($employeeId)->findOrFail($salaryId);
        $salary->delete();

        return response()->json([
            'message' => 'Salary Successfully deleted.'
        ]);
    }

    private function createOrUpdate(Salary $salary, Request $request)
    {
        $this->validate($request, [
            'hourly_rate' => 'required',
            'hours_spent' => 'required',
            'total_amount' => 'present',
            'start_at' => 'required|date_format:Y-m-d H:i:s',
            'end_at' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required',
        ]);

        $salary->fill($request->all());
        $salary->save();

        return $salary;
    }
}
