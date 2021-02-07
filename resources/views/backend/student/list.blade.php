@extends('backend.layouts.main')
@section('title', 'Student Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Student</a></li>
    <li class="breadcrumb-item active">List</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title"><span><a  href="{{route('students.create')}}" class="btn btn-outline-info">ADD </button></a></span> Student List</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="studentTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="100px">Photo</th>
                        <th width="25%">Name</th>
                        <th width="15%">Admission No</th>
                        <th width="10%">Roll No</th>
                        <th width="10%">Class</th>
                        <th width="10%">Section</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student as $data)
                        <tr>
                            <td>{{++$i}}</td>
                            <td><img style="width: 50px;" src="{{ asset('storage/images/students/'.$data->student_photo)}}"> </td>
                            <td>{{$data->full_name}}</td>
                            <td>{{$data->admission_no}}</td>
                            <td>{{$data->roll_no}}</td>
                            <td>{{$data->classes->classes}}</td>
                            <td>{{$data->sections->sections}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu text-right dropdown-menu-right">
                                        <a href="{{route('students.show',$data->id)}}" > <button  class="dropdown-item" type="button">View Details</button> </a>
                                        <a href="{{route('students.edit',$data->id)}}" > <button  class="dropdown-item" type="button">Edit</button></a>
                                        <a href="#" onclick="changeStatus({{$data->id}})" > <button  class="dropdown-item" type="button">Deactivate</button> </a>
                                        <form id="deletForm{{$data->id}}" action="{{route('students.destroy', $data->id)}}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete({{$data->id}})" type="button" class="dropdown-item">Delete</button>
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
        $("#studentTable").DataTable();
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
                    let url = "{{url('students/status/change')}}"+'/'+id;
                    $(location).attr('href',url);
                } else {
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
