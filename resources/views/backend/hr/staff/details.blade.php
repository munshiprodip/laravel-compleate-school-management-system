
@extends('backend.layouts.main')
@section('title', 'HR Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Staffs</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')

        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('storage/images/staffs/'.$staff->staff_photo)}}"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$staff->full_name}}</h3>

                    <p class="text-muted text-center">{{$staff->designations->designation}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Mobile</b> <a class="float-right">{{$staff->mobile}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{$staff->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Blood Group</b> <a class="float-right">{{$staff->bloodgroups->bloodgroups}}</a>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="{{$staff->facebook_url}}" class="btn btn-primary"><b><i class="fab fa-facebook-f"></i></b></a>
                        <a href="{{$staff->twiteer_url}}" class="btn btn-primary"><b><i class="fab fa-twitter"></i></b></a>
                        <a href="{{$staff->instagram_url}}" class="btn btn-primary"><b><i class="fab fa-instagram"></i></b></a>
                        <a href="{{$staff->linkedin_url}}" class="btn btn-primary"><b><i class="fab fa-linkedin-in"></i></b></a>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>

                    <p class="text-muted">
                        {{$staff->qualification}}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                    <p class="text-muted">{{$staff->current_address}}</p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                    <p class="text-muted">{{$staff->notes}}</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab">Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact" data-toggle="tab">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#doccument" data-toggle="tab">Documents</a></li>
                        <li class="nav-item"><a class="nav-link" href="#leave" data-toggle="tab">Leave</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bank" data-toggle="tab">Bank Info</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="details">

                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Staff ID</b> <a class="float-right">{{$staff->staff_id}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>First Name</b> <a class="float-right">{{$staff->first_name}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Last Name</b> <a class="float-right">{{$staff->last_name}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Father's Name</b> <a class="float-right">{{$staff->fathers_name}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Mother's Name</b> <a class="float-right">{{$staff->mothers_name}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Date of Birth</b> <a class="float-right">{{$staff->date_of_birth}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Joining Date</b> <a class="float-right">{{$staff->date_of_joining}}</a>
                                        </li>


                                        <li class="list-group-item">
                                            <b>Marital Status</b> <a class="float-right">{{$staff->marital_status}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Job Type</b> <a class="float-right">{{$staff->contract_type}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Notes</b> <a class="float-right">{{$staff->notes}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Driving Lincense</b> <a class="float-right">{{$staff->driving_license}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Driving Lincense Expire Date</b> <a class="float-right">{{$staff->driving_license_ex_date}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Designation </b> <a class="float-right">{{$staff->designations->designation}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Department</b> <a class="float-right">{{$staff->departments->department}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Gender</b> <a class="float-right">{{$staff->genders->genders}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Blood Group</b> <a class="float-right">{{$staff->bloodgroups->bloodgroups}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Religion</b> <a class="float-right">{{$staff->religion->religions}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="contact">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right">{{$staff->email}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Mobile</b> <a class="float-right">{{$staff->mobile}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Emergency Contact</b> <a class="float-right">{{$staff->emergency_mobile}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Facebook</b> <a class="float-right">{{$staff->facebook_url}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Twiteer</b> <a class="float-right">{{$staff->twiteer_url}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Linked in</b> <a class="float-right">{{$staff->linkedin_url}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Instagram</b> <a class="float-right">{{$staff->instagram_url}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="doccument">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Joining Letter</b> <a class="float-right">{{$staff->joining_letter}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Resume</b> <a class="float-right">{{$staff->resume}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Other's Doccument</b> <a class="float-right">{{$staff->other_document}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="leave">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Casual Leave</b> <a class="float-right">{{$staff->casual_leave}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Medical Leave</b> <a class="float-right">{{$staff->medical_leave}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Metarnity Leave</b> <a class="float-right">{{$staff->metarnity_leave}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="bank">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Account Name</b> <a class="float-right">{{$staff->bank_account_name}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Account No</b> <a class="float-right">{{$staff->bank_account_no}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bank Name</b> <a class="float-right">{{$staff->bank_name}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Branch</b> <a class="float-right">{{$staff->bank_branch}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
@endsection

@section('script')

@endsection


