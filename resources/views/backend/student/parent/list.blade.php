@extends('backend.layouts.main')
@section('title', 'Student Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Parent's</a></li>
    <li class="breadcrumb-item active">List</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title">Parent List</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="parentsTable" class="table table-bordered ">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="200px">Parent's Photo</th>
                        <th width="15%">Parent's Name</th>
                        <th width="15%">Parent's Occupation</th>
                        <th width="15%">Parent's Phone</th>
                        <th width="15%">Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parents as $data)
                        <tr>
                            <td rowspan="2">{{++$i}}</td>
                            <td rowspan="2">
                                <div style="width: 104px;">
                                    <img style="width: 50px;" src="{{ asset('storage/images/parents/'.$data->fathers_photo)}}">
                                    <img style="width: 50px;" src="{{ asset('storage/images/parents/'.$data->mothers_photo)}}">
                                </div>
                            </td>
                            <td>{{$data->fathers_name}}</td>
                            <td >{{$data->fathers_occupation}}</td>
                            <td >{{$data->fathers_mobile}}</td>
                            <td rowspan="2">{{$data->user->email}}</td>
                            <td rowspan="2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu text-right dropdown-menu-right">
                                        <a href="#" > <button  class="dropdown-item" data-toggle="modal" data-target="#modal-lg-{{$data->id}}" type="button">View Children</button> </a>
                                        <a href="#" > <button  class="dropdown-item" type="button">Edit</button></a>
                                        <a href="#" > <button  class="dropdown-item" type="button">Deactivate</button> </a>
                                        <form action="#" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{$data->mothers_name}}</td>
                            <td>{{$data->mothers_occupation}}</td>
                            <td style="border-right: 1px solid #ddd;">{{$data->mothers_mobile}}</td>

                            <div class="modal fade" id="modal-lg-{{$data->id}}" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Children List</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                @foreach($data->students as $child)
                                                    <div class="col-6">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-body box-profile">
                                                                <div class="text-center">
                                                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/images/students/'.$child->student_photo)}}" alt="User profile picture">
                                                                </div>

                                                                <h3 class="profile-username text-center">{{$child->full_name}}</h3>

                                                                <p class="text-muted text-center">{{$child->admission_no}}</p>

                                                                <ul class="list-group list-group-unbordered mb-3">
                                                                    <li class="list-group-item">
                                                                        <b>Roll No</b> <a class="float-right">{{$child->roll_no}}</a>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <b>Class</b> <a class="float-right">{{$child->classes->classes}}</a>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <b>Section</b> <a class="float-right">{{$child->sections->sections}}</a>
                                                                    </li>
                                                                </ul>

                                                                <a href="{{route('students.show', $child->id)}}" class="btn btn-primary btn-block"><b>View Details</b></a>
                                                            </div>
                                                            <!-- /.card-body -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

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
        $("#parentsTable").DataTable();
    </script>
@endsection


