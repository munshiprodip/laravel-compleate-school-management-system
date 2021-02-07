<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpSalaryDeduction;
use App\Models\EpSalaryProcess;
use App\Models\EpStaff;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function salaryDeduction(){
        $year = date('Y');
        $month = date('m');
        $employee = EpStaff::all();
        $i = 0;

        return view('backend.accounts.salary.deduction', compact( 'employee', 'year', 'month', 'i'));
    }
    public function salaryDeductionStore(Request $request){
        $create = EpSalaryDeduction::create($request->all());
        if ($create){
            return redirect()->route('salary.deduction');
        }

    }
    public function salaryDeductionUpdate(Request $request, $id){
        $deduction = EpSalaryDeduction::find($id);
        $update = $deduction->update($request->all());
        return redirect()->route('salary.deduction');
    }
    public function salaryProcess(){
        $last_salary = EpSalaryProcess::latest('id')->first();
        $i = 0;
        $employee = EpStaff::where('active_status', 1)->get();
        return view('backend.accounts.salary.index', compact('employee', 'i', 'last_salary'));
    }

    public function salaryProcessSubmit(Request $request){

        $data = $request->row;
        foreach ($data as $row){
            $create = EpSalaryProcess::create($row);
        }
        return back();

    }
    public function salarySheet(){
        $i = 0;
        $year = date('Y');
        $month = date('m');
        $salary_sheet = EpSalaryProcess::where('salary_year', $year)->where('salary_month', $month)->get();

        return view('backend.accounts.salary.sheet', compact('salary_sheet', 'i'));

    }
    public function salaryPay($id){
        $salary = EpSalaryProcess::find($id);
        $paid = $salary->update(['status' => 'Paid']);
        return redirect()->route('salary.sheet');
    }
    public function salaryDetails($id){
        $salary = EpSalaryProcess::find($id);
        return view('backend.accounts.salary.details', compact('salary'));
    }
}
