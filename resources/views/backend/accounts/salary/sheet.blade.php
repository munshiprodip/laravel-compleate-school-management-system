@extends('backend.layouts.main')
@section('title', 'Accounts Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Accounts</a></li>
    <li class="breadcrumb-item"><a href="#">Salary</a></li>
    <li class="breadcrumb-item active">Sheet</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title"> Salary Sheet</h3>

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
                        <th width="10%">ID</th>
                        <th width="20%">Name</th>
                        <th width="15%">Gross Salary</th>
                        <th width="15%">Deduction</th>
                        <th width="15%">Net Payable</th>
                        <th width="15%">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salary_sheet as $data)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$data->employee->staff_id}}</td>
                        <td>{{$data->employee->full_name}}</td>
                        <td>{{$data->gross_salary}}</td>
                        <td>{{$data->d_total_deduction}}</td>
                        <td>{{$data->net_salary}}</td>
                        <td>
                            <span class="badge {{($data->status == 'Unpaid')?'bg-warning': 'bg-primary'}}">{{$data->status}}</span>
                        </td>
                        <td>
                            @if($data->status == 'Unpaid')
                            <button onclick="confirmPay({{$data->id}})" class="btn btn-success btn-xs">Pay</button>
                            @else
                            <a target="_blank" href="{{route('salary.details', $data->id)}}" class="btn btn-info btn-xs">View</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>



@endsection

@section('script')
    <script type="text/javascript">
        function confirmPay(id){
            swal.fire({
                title: "Payment Confirm?",
                text: "Please ensure and then confirm!",
                showCancelButton: !0,
                confirmButtonText: "Yes, Paid!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then( function (e) {
                if (e.value === true){
                    let url = "{{url('salary/pay')}}"+'/'+id;
                    $(location).attr('href',url);
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }

    </script>
@endsection

