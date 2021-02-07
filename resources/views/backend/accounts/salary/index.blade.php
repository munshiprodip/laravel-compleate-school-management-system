@extends('backend.layouts.main')
@section('title', 'Accounts Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Accounts</a></li>
    <li class="breadcrumb-item active">Salary</li>
@endsection

@section('content')
    @if($last_salary)
        @if($last_salary->salary_year == date('Y') && $last_salary->salary_month == date('m'))
            <div class="col-12 text-center">
                <h1>This Month's Salary already processed</h1>
            </div>
        @else
            <div class="col-12">
                <!-- Default box -->
                <div class="card card-dark">
                    <div class="card-header">

                        <h3 class="card-title"><span><a onclick="confirmSubmit()" href="#" class="btn btn-outline-info">Process Salary </button></a></span></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('salary.process.submit')}}" method="POST" id="salaryProcess" >
                            @csrf

                            <table id="departmentTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th rowspan="2" width="10%">ID</th>
                                    <th rowspan="2" width="10%">Name</th>
                                    <th rowspan="2" width="10%">Designation</th>
                                    <th colspan="6">Salary</th>
                                    <th colspan="7">Deduction</th>
                                    <th rowspan="2" width="10%">Net Salary</th>
                                </tr>
                                <tr>
                                    <th width="10%">Basic</th>
                                    <th width="10%">HR</th>
                                    <th width="10%">CA</th>
                                    <th width="10%">MA</th>
                                    <th width="10%">Others</th>
                                    <th width="10%">Gross</th>

                                    <th width="10%">PF</th>
                                    <th width="10%">Insurance</th>
                                    <th width="10%">loan</th>
                                    <th width="10%">HR</th>
                                    <th width="10%">Utility</th>
                                    <th width="10%">others</th>
                                    <th width="10%">Total</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employee as $data)
                                    @php ++$i; @endphp

                                    <tr>
                                        <input type="hidden" name="row[{{$i}}][salary_year]" value="{{date('Y')}}" >
                                        <input type="hidden" name="row[{{$i}}][salary_month]" value="{{date('m')}}" >

                                        <input type="hidden" name="row[{{$i}}][staff_id]" value="{{$data->id}}" >
                                        <input type="hidden" name="row[{{$i}}][basic_salary]" value="{{$data->basic_salary}}" >
                                        <input type="hidden" name="row[{{$i}}][house_rent]" value="{{$data->house_rent}}" >
                                        <input type="hidden" name="row[{{$i}}][conveyance_allowance]" value="{{$data->conveyance_allowance}}" >
                                        <input type="hidden" name="row[{{$i}}][medical_allowance]" value="{{$data->medical_allowance}}" >
                                        <input type="hidden" name="row[{{$i}}][other_allowance]" value="{{$data->other_allowance}}" >
                                        <input type="hidden" name="row[{{$i}}][gross_salary]" value="{{$data->gross_salary}}" >

                                        <input type="hidden" name="row[{{$i}}][created_by]" value="{{ Auth::user()->id }}" >



                                        <td>{{$data->staff_id}}</td>
                                        <td>{{$data->full_name}}</td>
                                        <td>{{$data->designations->designation}}</td>
                                        <td>{{$data->basic_salary}}</td>
                                        <td>{{$data->house_rent}}</td>
                                        <td>{{$data->conveyance_allowance}}</td>
                                        <td>{{$data->medical_allowance}}</td>
                                        <td>{{$data->other_allowance}}</td>
                                        <td><mark>{{$data->gross_salary}}</mark></td>

                                        @php
                                            $deduction = \App\Models\EpSalaryDeduction::select("*")
                                                        ->where("staff_id", $data->id)
                                                        ->get()
                                                        ->first();
                                        @endphp
                                        @if($deduction)

                                            <input type="hidden" name="row[{{$i}}][d_pf]" value="{{$deduction->pf}}" >
                                            <input type="hidden" name="row[{{$i}}][d_insurance]" value="{{$deduction->insurance}}" >
                                            <input type="hidden" name="row[{{$i}}][d_loan]" value="{{$deduction->loan}}" >
                                            <input type="hidden" name="row[{{$i}}][d_house_rent]" value="{{$deduction->house_rent}}" >
                                            <input type="hidden" name="row[{{$i}}][d_utility]" value="{{$deduction->utility}}" >
                                            <input type="hidden" name="row[{{$i}}][d_others]" value="{{$deduction->others}}" >
                                            <input type="hidden" name="row[{{$i}}][d_total_deduction]" value="{{$deduction->total}}" >

                                            <input type="hidden" name="row[{{$i}}][net_salary]" value="{{$data->gross_salary-$deduction->total}}" >


                                            <td>{{$deduction->pf}}</td>
                                            <td>{{$deduction->insurance}}</td>
                                            <td>{{$deduction->loan}}</td>
                                            <td>{{$deduction->house_rent}}</td>
                                            <td>{{$deduction->utility}}</td>
                                            <td>{{$deduction->others}}</td>
                                            <td><mark>{{$deduction->total}}</mark></td>
                                            <td><mark>{{$data->gross_salary-$deduction->total}}</mark></td>
                                        @else
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td><mark>{{$data->gross_salary}}</mark></td>

                                            <input type="hidden" name="row[{{$i}}][d_pf]" value="0" >
                                            <input type="hidden" name="row[{{$i}}][d_insurance]" value="0" >
                                            <input type="hidden" name="row[{{$i}}][d_loan]" value="0" >
                                            <input type="hidden" name="row[{{$i}}][d_house_rent]" value="0" >
                                            <input type="hidden" name="row[{{$i}}][d_utility]" value="0" >
                                            <input type="hidden" name="row[{{$i}}][d_others]" value="0" >
                                            <input type="hidden" name="row[{{$i}}][d_total_deduction]" value="0" >

                                            <input type="hidden" name="row[{{$i}}][net_salary]" value="{{$data->gross_salary}}" >
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        @endif
    @else
        <div class="col-12">
            <!-- Default box -->
            <div class="card card-dark">
                <div class="card-header">

                    <h3 class="card-title"><span><a onclick="confirmSubmit()" href="#" class="btn btn-outline-info">Process Salary </button></a></span></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('salary.process.submit')}}" method="POST" id="salaryProcess" >
                        @csrf

                        <table id="departmentTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" width="10%">ID</th>
                                <th rowspan="2" width="10%">Name</th>
                                <th rowspan="2" width="10%">Designation</th>
                                <th colspan="6">Salary</th>
                                <th colspan="7">Deduction</th>
                                <th rowspan="2" width="10%">Net Salary</th>
                            </tr>
                            <tr>
                                <th width="10%">Basic</th>
                                <th width="10%">HR</th>
                                <th width="10%">CA</th>
                                <th width="10%">MA</th>
                                <th width="10%">Others</th>
                                <th width="10%">Gross</th>

                                <th width="10%">PF</th>
                                <th width="10%">Insurance</th>
                                <th width="10%">loan</th>
                                <th width="10%">HR</th>
                                <th width="10%">Utility</th>
                                <th width="10%">others</th>
                                <th width="10%">Total</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employee as $data)
                                @php ++$i; @endphp

                                <tr>
                                    <input type="hidden" name="row[{{$i}}][salary_year]" value="{{date('Y')}}" >
                                    <input type="hidden" name="row[{{$i}}][salary_month]" value="{{date('m')}}" >

                                    <input type="hidden" name="row[{{$i}}][staff_id]" value="{{$data->id}}" >
                                    <input type="hidden" name="row[{{$i}}][basic_salary]" value="{{$data->basic_salary}}" >
                                    <input type="hidden" name="row[{{$i}}][house_rent]" value="{{$data->house_rent}}" >
                                    <input type="hidden" name="row[{{$i}}][conveyance_allowance]" value="{{$data->conveyance_allowance}}" >
                                    <input type="hidden" name="row[{{$i}}][medical_allowance]" value="{{$data->medical_allowance}}" >
                                    <input type="hidden" name="row[{{$i}}][other_allowance]" value="{{$data->other_allowance}}" >
                                    <input type="hidden" name="row[{{$i}}][gross_salary]" value="{{$data->gross_salary}}" >

                                    <input type="hidden" name="row[{{$i}}][created_by]" value="{{ Auth::user()->id }}" >



                                    <td>{{$data->staff_id}}</td>
                                    <td>{{$data->full_name}}</td>
                                    <td>{{$data->designations->designation}}</td>
                                    <td>{{$data->basic_salary}}</td>
                                    <td>{{$data->house_rent}}</td>
                                    <td>{{$data->conveyance_allowance}}</td>
                                    <td>{{$data->medical_allowance}}</td>
                                    <td>{{$data->other_allowance}}</td>
                                    <td><mark>{{$data->gross_salary}}</mark></td>

                                    @php
                                        $deduction = \App\Models\EpSalaryDeduction::select("*")
                                                    ->where("staff_id", $data->id)
                                                    ->get()
                                                    ->first();
                                    @endphp
                                    @if($deduction)

                                        <input type="hidden" name="row[{{$i}}][d_pf]" value="{{$deduction->pf}}" >
                                        <input type="hidden" name="row[{{$i}}][d_insurance]" value="{{$deduction->insurance}}" >
                                        <input type="hidden" name="row[{{$i}}][d_loan]" value="{{$deduction->loan}}" >
                                        <input type="hidden" name="row[{{$i}}][d_house_rent]" value="{{$deduction->house_rent}}" >
                                        <input type="hidden" name="row[{{$i}}][d_utility]" value="{{$deduction->utility}}" >
                                        <input type="hidden" name="row[{{$i}}][d_others]" value="{{$deduction->others}}" >
                                        <input type="hidden" name="row[{{$i}}][d_total_deduction]" value="{{$deduction->total}}" >

                                        <input type="hidden" name="row[{{$i}}][net_salary]" value="{{$data->gross_salary-$deduction->total}}" >


                                        <td>{{$deduction->pf}}</td>
                                        <td>{{$deduction->insurance}}</td>
                                        <td>{{$deduction->loan}}</td>
                                        <td>{{$deduction->house_rent}}</td>
                                        <td>{{$deduction->utility}}</td>
                                        <td>{{$deduction->others}}</td>
                                        <td><mark>{{$deduction->total}}</mark></td>
                                        <td><mark>{{$data->gross_salary-$deduction->total}}</mark></td>
                                    @else
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><mark>{{$data->gross_salary}}</mark></td>

                                        <input type="hidden" name="row[{{$i}}][d_pf]" value="0" >
                                        <input type="hidden" name="row[{{$i}}][d_insurance]" value="0" >
                                        <input type="hidden" name="row[{{$i}}][d_loan]" value="0" >
                                        <input type="hidden" name="row[{{$i}}][d_house_rent]" value="0" >
                                        <input type="hidden" name="row[{{$i}}][d_utility]" value="0" >
                                        <input type="hidden" name="row[{{$i}}][d_others]" value="0" >
                                        <input type="hidden" name="row[{{$i}}][d_total_deduction]" value="0" >

                                        <input type="hidden" name="row[{{$i}}][net_salary]" value="{{$data->gross_salary}}" >
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    @endif


@endsection

@section('script')
    <script>
        function confirmSubmit(){
            swal.fire({
                title: "Proceed to Process?",
                text: "Please ensure and then confirm!",
                showCancelButton: !0,
                confirmButtonText: "Yes, Proceed!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then( function (e) {
                if (e.value === true){
                    $('#salaryProcess').submit();
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
    </script>
@endsection
