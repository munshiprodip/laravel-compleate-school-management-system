@extends('backend.layouts.main')
@section('title', 'Accounts Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Accounts</a></li>
    <li class="breadcrumb-item"><a href="#">Salary</a></li>
    <li class="breadcrumb-item active">Deduction</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title">Salary Deduction</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="15%">Employee Name</th>
                        <th width="10%">Designation</th>
                        <th width="10%">PF</th>
                        <th width="10%">Insurance</th>
                        <th width="10%">Loan</th>
                        <th width="10%">House Rent</th>
                        <th width="10%">Utility</th>
                        <th width="10%">Others</th>
                        <th width="10%">Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employee as $data)
                        <tr>
                            @php $id = $data->id @endphp
                            <td>{{$data->staff_id}}</td>
                            <td>{{$data->full_name}}</td>
                            <td>{{$data->designations->designation}}</td>
                            @php
                                $deduction = \App\Models\EpSalaryDeduction::select("*")
                                            ->where("staff_id", $data->id)
                                            ->where("deduction_year", $year)
                                            ->where("deduction_month", $month)
                                            ->get()
                                            ->first();;
                            @endphp
                            @if($deduction)
                            <td>{{$deduction->pf}}</td>
                            <td>{{$deduction->insurance}}</td>
                            <td>{{$deduction->loan}}</td>
                            <td>{{$deduction->house_rent}}</td>
                            <td>{{$deduction->utility}}</td>
                            <td>{{$deduction->others}}</td>
                            <td>{{$deduction->total}}</td>
                            <td><a href="#editDeduction" data-toggle="modal" class="btn btn-success btn-xs">Edit</a> </td>
                                <!-- Modal for Edit  -->
                                <div class="modal fade" id="editDeduction">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{route('salary.deduction.update', $deduction->id)}}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Deduction</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>PF</label>
                                                                <input type="number" name="pf" class="form-control" value="{{$deduction->pf}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Insurance</label>
                                                                <input type="number" name="insurance" class="form-control" value="{{$deduction->insurance}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Loan</label>
                                                                <input type="number" name="loan" class="form-control" value="{{$deduction->loan}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>House Rent</label>
                                                                <input type="number" name="house_rent" class="form-control" value="{{$deduction->house_rent}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Utility</label>
                                                                <input type="number" name="utility" class="form-control" value="{{$deduction->utility}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Others</label>
                                                                <input type="number" name="others" class="form-control" value="{{$deduction->others}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Total</label>
                                                                <input type="number" name="total" class="form-control" value="{{$deduction->total}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="#addDeduction" data-toggle="modal"  class="btn btn-primary btn-xs">Add</a> </td>
                                <!-- Modal for Edit  -->
                                <div class="modal fade" id="addDeduction">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{route('salary.deduction.store')}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Deduction</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>PF</label>
                                                                <input type="number" name="pf" class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Insurance</label>
                                                                <input type="number" name="insurance" class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Loan</label>
                                                                <input type="number" name="loan" class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>House Rent</label>
                                                                <input type="number" name="house_rent" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Utility</label>
                                                                <input type="number" name="utility" class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Others</label>
                                                                <input type="number" name="others" class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Total</label>
                                                                <input type="number" name="total" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <input type="hidden" name="deduction_year" value="{{$year}}">
                                                    <input type="hidden" name="deduction_month" value="{{$month}}">
                                                    <input type="hidden" name="staff_id" value="{{$id}}">
                                                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <!-- Modal for Add Blood Group -->
    <div class="modal fade" id="addClass">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Class</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="classes" class="form-control" required autofocus >
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@endsection

@section('script')
    <script type="text/javascript">


    </script>
@endsection

