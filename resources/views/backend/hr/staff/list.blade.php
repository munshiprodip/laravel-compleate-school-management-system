
@extends('backend.layouts.main')
@section('title', 'HR Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Employee</a></li>
    <li class="breadcrumb-item active">List</li>
@endsection

@section('content')
{{--    @foreach($staffs as $staff)--}}
{{--    <div class="col-md-3">--}}
{{--        <!-- Profile Image -->--}}
{{--        <div class="card card-primary card-outline">--}}
{{--            <div class="card-body box-profile">--}}
{{--                <div class="text-center">--}}
{{--                    <img class="profile-user-img img-fluid img-circle"--}}
{{--                         src="{{ asset('storage/images/staffs/'.$staff->staff_photo)}}"--}}
{{--                         alt="User profile picture">--}}
{{--                </div>--}}

{{--                <h3 class="profile-username text-center">{{$staff->full_name}}</h3>--}}

{{--                <p class="text-muted text-center">{{$staff->designations->designation}}</p>--}}

{{--                <ul class="list-group list-group-unbordered mb-3">--}}
{{--                    <li class="list-group-item">--}}
{{--                        <b>Mobile</b> <a class="float-right">{{$staff->mobile}}</a>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item">--}}
{{--                        <b>Email</b> <a class="float-right">{{$staff->email}}</a>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item">--}}
{{--                        <b>Blood Group</b> <a class="float-right">{{$staff->bloodgroups->bloodgroups}}</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <div class="text-center">--}}
{{--                    <a href="{{$staff->facebook_url}}" class="btn btn-primary"><b><i class="fab fa-facebook-f"></i></b></a>--}}
{{--                    <a href="{{$staff->twiteer_url}}" class="btn btn-primary"><b><i class="fab fa-twitter"></i></b></a>--}}
{{--                    <a href="{{$staff->instagram_url}}" class="btn btn-primary"><b><i class="fab fa-instagram"></i></b></a>--}}
{{--                    <a href="{{$staff->linkedin_url}}" class="btn btn-primary"><b><i class="fab fa-linkedin-in"></i></b></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}
{{--    </div>--}}
{{--    @endforeach--}}

    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title"><span><a  href="{{route('staffs.create')}}" class="btn btn-outline-info">ADD </button></a></span> Employee List</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="staffTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="100px">Photo</th>
                        <th width="100px">Employee ID</th>
                        <th width="20%">Name</th>
                        <th width="10%">Department</th>
                        <th width="10%">Designation</th>
                        <th width="10%">Mobile</th>
                        <th width="10%">Gender</th>
                        <th width="10%">Blood Group</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($staffs as $data)
                        <tr>
                            <td>{{++$i}}</td>
                            <td><img style="width: 50px;" src="{{ asset('storage/images/staffs/'.$data->staff_photo)}}"> </td>
                            <td>{{$data->staff_id}}</td>
                            <td>{{$data->full_name}}</td>
                            <td>{{$data->departments->department}}</td>
                            <td>{{$data->designations->designation}}</td>
                            <td>{{$data->mobile}}</td>
                            <td>{{$data->genders->genders}}</td>
                            <td>{{$data->bloodgroups->bloodgroups}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu text-right dropdown-menu-right">
                                        <a href="{{route('staffs.show',$data->id)}}" > <button  class="dropdown-item" type="button">View Details</button> </a>
                                        <a href="{{route('staffs.edit',$data->id)}}" > <button  class="dropdown-item" type="button">Edit</button></a>
                                        <a href="#" onclick="changeStatus({{$data->id}})" > <button  class="dropdown-item" type="button">Deactivate</button> </a>
                                        <form id="deletForm{{$data->id}}" action="{{route('staffs.destroy', $data->id)}}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete({{$data->id}})" class="dropdown-item" type="button">Delete</button>
                                        </form>

                                    </div>
                                </div>
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

    <script>
        $("#staffTable").DataTable();

        function changeStatus(id){
            swal.fire({
                title: "Deactivate Status?",
                text: "Please ensure and then confirm!",
                showCancelButton: !0,
                confirmButtonText: "Yes, Deactivate!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then( function (e) {
                if (e.value === true){
                    var url = "{{url('staffs/status/change')}}"+'/'+id;
                    $.ajax({
                        url:url,
                        type:"GET",
                        dataType:"JSON",
                        success: function (data){
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,

                            })

                            if (data.success === true) {
                                Toast.fire("Done!", data.message, "success");
                            } else {
                                Toast.fire("Error!", data.message, "error");
                            }

                            location.reload();
                        },
                        error: function (){
                            alert('Error');
                        }
                    });
                } else {
                    location.reload();
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
        function confirmDelete(id){
            swal.fire({
                title: "Delete Student?",
                text: "Please ensure and then confirm!",
                showCancelButton: !0,
                confirmButtonText: "Yes, Delete!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then( function (e) {
                if (e.value === true){
                    $('#deletForm'+id).submit();
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
    </script>
@endsection
