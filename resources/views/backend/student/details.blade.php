@extends('backend.layouts.main')
@section('title', 'Student Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Student</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student Information</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img width="100%" src="{{ asset('storage/images/students/'.$data->student_photo)}}">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <h3>{{$data->full_name}}</h3>
                            </div>

                            <div class="col-12">
                                <table class="table">
                                    <tr>
                                        <th width="20%">Admission No</th> <td>:</td> <td width="30%">{{$data->admission_no}}</td>
                                        <th width="20%">Bank Account No</th> <td>:</td> <td width="30%">{{$data->bank_account_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>Session</th> <td>:</td> <td>{{$data->sessions->sessions}}</td>
                                        <th>Bank Name</th> <td>:</td> <td>{{$data->bank_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Class</th> <td>:</td> <td>{{$data->classes->classes}}</td>
                                        <th>Current Address</th> <td>:</td> <td>{{$data->current_address}}</td>
                                    </tr>
                                    <tr>
                                        <th>Section</th> <td>:</td> <td>{{$data->sections->sections}}</td>
                                        <th>Permanent Address</th> <td>:</td> <td>{{$data->permanent_address}}</td>
                                    </tr>
                                    <tr>
                                        <th>Roll No</th> <td>:</td> <td>{{$data->roll_no}}</td>
                                        <th>Previous School Information</th> <td>:</td> <td>{{$data->previous_school_information}}</td>
                                    </tr>
                                    <tr>
                                        <th>Blood Group</th> <td>:</td> <td>{{$data->bloodgroups->bloodgroups}}</td>
                                        <th>Additional Notes</th> <td>:</td> <td>{{$data->additional_notes}}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th> <td>:</td> <td>{{$data->genders->genders}}</td>
                                        <th>Admission Date</th> <td>:</td> <td>{{$data->admission_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th> <td>:</td> <td>{{$data->religion->religions}}</td>
                                        <th>Student Category</th> <td>:</td> <td>{{$data->student_category_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th> <td>:</td> <td>{{$data->date_of_birth}}</td>
                                        <th>Mobile</th> <td>:</td> <td>{{$data->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>Birth Reg No</th> <td>:</td> <td>{{$data->national_id}}</td>
                                        <th>Email</th> <td>:</td> <td>{{$data->user->email}}</td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-6">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Father's Information</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img width="100%" src="{{ asset('storage/images/parents/'.$data->parents->fathers_photo)}}">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <h3>{{$data->parents->fathers_name}}</h3>
                                <hr/>
                            </div>

                            <div class="col-12">
                                <table class="table">
                                    <tr>
                                        <th>Occupation</th> <td>:</td> <td>{{$data->parents->fathers_occupation}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th> <td>:</td> <td>{{$data->parents->fathers_mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th> <td>:</td> <td>{{$data->parents->user->email}}</td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-6">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mother's Information</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img width="100%" src="{{ asset('storage/images/parents/'.$data->parents->mothers_photo)}}">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <h3>{{$data->parents->mothers_name}}</h3>
                                <hr/>
                            </div>

                            <div class="col-12">
                                <table class="table">
                                    <tr>
                                        <th>Occupation</th> <td>:</td> <td>{{$data->parents->mothers_occupation}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th> <td>:</td> <td>{{$data->parents->mothers_mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th> <td>:</td> <td>{{$data->parents->user->email}}</td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
@endsection
