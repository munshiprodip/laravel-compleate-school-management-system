@extends('backend.layouts.main')
@section('title', 'HR Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Staff</a></li>
    <li class="breadcrumb-item active">Join</li>
@endsection

@section('content')
    <div class="col-12">

        <!-- Default box -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Employee Joining Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{route('staffs.store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input style="height: 30px;" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="first_name"  placeholder="Enter first name" >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input style="height: 30px;" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" id="last_name" placeholder="Enter last name" >
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input style="height: 30px;" type="email" class="form-control" name="email" value="{{ old('email') }}" id="email"  placeholder="" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fathers_name">Father's Name * </label>
                                <input style="height: 30px;" type="text" class="form-control" name="fathers_name" value="{{ old('fathers_name') }}" id="fathers_name" placeholder="" >
                            </div>
                        </div>
                        <!--             Row              -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="mothers_name">Mother's Name * </label>
                                <input  style="height: 30px;" type="text" class="form-control" name="mothers_name" value="{{ old('mothers_name') }}" id="mothers_name" placeholder="" >
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="gender_id">Gender *</label>
                                <select class=" form-control select2" name="gender_id" style="width: 100%;" >
                                    <option value="">Select one</option>
                                    @foreach($gender as $data)
                                        <option value="{{$data->id}}">{{$data->genders}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="bloodgroup_id">Blood group * </label>
                                <select class=" form-control select2" id="bloodgroup_id" name="bloodgroup_id"  style="width: 100%;" >
                                    <option value="">Select one </option>
                                    @foreach($blood as $data)
                                        <option value="{{$data->id}}">{{$data->bloodgroups}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="religion_id">Religion</label>
                                <select class=" form-control select2" id="religion_id" name="religion_id" style="width: 100%;" >
                                    <option value="">Select one </option>
                                    @foreach($religion as $data)
                                        <option value="{{$data->id}}">{{$data->religions}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select class=" form-control select2" id="department_id" name="department_id" style="width: 100%;" >
                                    <option value="">Select one </option>
                                    @foreach($department as $data)
                                        <option value="{{$data->id}}">{{$data->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="designation_id">Designation</label>
                                <select class=" form-control select2" id="designation_id" name="designation_id" style="width: 100%;" >
                                    <option value="">Select one </option>
                                    @foreach($designation as $data)
                                        <option value="{{$data->id}}">{{$data->designation}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="contract_type">Job Type</label>
                                <select class=" form-control select2" id="contract_type" name="contract_type" style="width: 100%;" >
                                    <option value="Provisional">Provisional </option>
                                    <option value="Permanent">Permanent </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label >Date of Birth</label>
                                <div class="input-group date" id="date_of_birth"  data-target-input="nearest">
                                    <input style="height: 30px;" type="text" class="form-control datetimepicker-input" name="date_of_birth" value="{{ old('date_of_birth') }}" data-target="#date_of_birth" />
                                    <div class="input-group-append" data-target="#date_of_birth" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label >Joining Date</label>
                                <div class="input-group date" id="date_of_joining"  data-target-input="nearest">
                                    <input style="height: 30px;" type="text" class="form-control datetimepicker-input" name="date_of_joining" value="{{ old('date_of_joining') }}" data-target="#date_of_joining" />
                                    <div class="input-group-append" data-target="#date_of_joining" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="mobile">Mobile No </label>
                                <input style="height: 30px;" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" id="mobile" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="emergency_mobile">Emergency Contact No </label>
                                <input style="height: 30px;" type="text" class="form-control" name="emergency_mobile" value="{{ old('emergency_mobile') }}" id="emergency_mobile" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="nid">NID * </label>
                                <input style="height: 30px;" type="text" class="form-control" name="nid" value="{{ old('nid') }}" id="nid" placeholder="" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="marital_status">Marital Status</label>
                                <select class=" form-control select2" id="marital_status" name="marital_status" style="width: 100%;" >
                                    <option value="">Select one </option>
                                    <option value="Unmarried">Unmarried </option>
                                    <option value="Married">Married </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="bank_account_name">Bank Account Name </label>
                                <input style="height: 30px;" type="text" class="form-control" name="bank_account_name" value="{{ old('bank_account_name') }}" id="bank_account_name" placeholder="" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="bank_account_no">Bank Account No </label>
                                <input style="height: 30px;" type="text" class="form-control" name="bank_account_no" value="{{ old('bank_account_no') }}" id="bank_account_no" placeholder="" >
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="bank_name">Bank Name </label>
                                <input style="height: 30px;" type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}" id="bank_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="bank_branch">Branch Name </label>
                                <input style="height: 30px;" type="text" class="form-control" name="bank_branch" value="{{ old('bank_branch') }}" id="bank_branch" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="facebook_url">Facebook Link </label>
                                <input style="height: 30px;" type="text" class="form-control" name="facebook_url" value="{{ old('facebook_url') }}" id="facebook_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="twiteer_url">Twitter Link </label>
                                <input style="height: 30px;" type="text" class="form-control" name="twiteer_url" value="{{ old('twiteer_url') }}" id="twiteer_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="linkedin_url">Linkedin Link </label>
                                <input style="height: 30px;" type="text" class="form-control" name="linkedin_url" value="{{ old('linkedin_url') }}" id="linkedin_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="instagram_url">Instagram Link </label>
                                <input style="height: 30px;" type="text" class="form-control" name="instagram_url" value="{{ old('instagram_url') }}" id="instagram_url" placeholder="">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="driving_license">Driving Lincense </label>
                                <input style="height: 30px;" type="text" class="form-control" name="driving_license" value="{{ old('driving_license') }}" id="driving_license" placeholder="">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label >Lincense Expire Date</label>
                                <div class="input-group date" id="driving_license_ex_date"  data-target-input="nearest">
                                    <input style="height: 30px;" type="text" class="form-control datetimepicker-input" name="driving_license_ex_date" value="{{ old('driving_license_ex_date') }}" data-target="#driving_license_ex_date" />
                                    <div class="input-group-append" data-target="#driving_license_ex_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="qualification">Qualification </label>
                                <input style="height: 30px;" type="text" class="form-control" name="qualification" value="{{ old('qualification') }}" id="qualification" placeholder="">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="basic_salary">Basic Salary </label>
                                <input style="height: 30px;" type="number" class="form-control" name="basic_salary" value="{{ old('basic_salary') }}" id="basic_salary" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="house_rent">House Rent </label>
                                <input style="height: 30px;" type="number" class="form-control" name="house_rent" value="{{ old('house_rent') }}" id="house_rent" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="conveyance_allowance">Conveyance Allowance </label>
                                <input style="height: 30px;" type="number" class="form-control" name="conveyance_allowance" value="{{ old('conveyance_allowance') }}" id="conveyance_allowance" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="medical_allowance">Medical Allowance </label>
                                <input style="height: 30px;" type="number" class="form-control" name="medical_allowance" value="{{ old('medical_allowance') }}" id="medical_allowance" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="other_allowance">Other Allowance </label>
                                <input style="height: 30px;" type="number" class="form-control" name="other_allowance" value="{{ old('other_allowance') }}" id="other_allowance" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="gross_salary">Gross Salary </label>
                                <input style="height: 30px;" type="number" class="form-control" name="gross_salary" value="{{ old('gross_salary') }}" id="gross_salary" placeholder="">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="staff_photo">Photo *</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input style="height: 30px;" type="file" name="staff_photo" class="custom-file-input" id="staff_photo">
                                        <label class="custom-file-label" for="staff_photo">Browse</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="joining_letter">Joining Letter *</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input style="height: 30px;" type="file" name="joining_letter" class="custom-file-input" id="joining_letter">
                                        <label class="custom-file-label" for="joining_letter">Browse</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="resume">Resume *</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input style="height: 30px;" type="file" name="resume" class="custom-file-input" id="resume">
                                        <label class="custom-file-label" for="resume">Browse</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="experience">Experience </label>
                                <textarea rows="2" class="form-control" name="experience" id="experience">{{ old('experience') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes </label>
                                <textarea rows="3" class="form-control" name="notes" id="notes">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="current_address">Present Address *</label>
                                <textarea rows="3" class="form-control" name="current_address" id="current_address">{{ old('current_address') }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address * <input class="" id="same_address" type="checkbox"> Same as present address?</label>
                                <textarea rows="3" class="form-control" name="permanent_address" id="permanent_address">{{ old('permanent_address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                    <button type="reset" class="btn btn-default">Clear</button>
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('script')

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        $(function () {
            //Initialize bsCustomFileInput
            bsCustomFileInput.init();
        })


        //Date range picker
        $('#date_of_birth').datetimepicker({
            format: 'L'
        });

        //Date range picker
        $('#date_of_joining').datetimepicker({
            format: 'L'
        });
        //Date range picker
        $('#driving_license_ex_date').datetimepicker({
            format: 'L'
        });




        $('#selectClass').on('change', function () {
            let id = $(this).val();
            if (id!==""){
                $.ajax({
                    url: "{{url('/classes/section')}}"+'/'+id,
                    type: "GET",
                    dataType:"JSON",
                    success:function (data) {
                        $("#sectionOption").empty()
                        $("#sectionOption").append('<option value="">Select one</option>')
                        let i;
                        for (i = 0; i < data[0].length; ++i) {
                            $("#sectionOption").append('<option value="'+data[0][i].id+'">'+data[0][i].sections+'</option>');
                        }
                    },
                    error: function () {
                        alert('Oops!!!');
                    }

                })
            }else {
                $("#sectionOption").empty()
                $("#sectionOption").append('<option value="">Select one</option>')
            }
        })

        $("#same_address").change(function() {
            if(this.checked) {
                let c_address = $("#current_address").val();
                $("#permanent_address").val(c_address);
            }else {
                $("#permanent_address").val('');
            }
        });


        $('#parents_id').on('change', function () {
            let id = $(this).val();
            if (id!==""){
                $("#parents_form").hide();
            }else {
                $("#parents_form").show();
            }
        })




    </script>
@endsection
