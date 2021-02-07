@extends('backend.layouts.main')
@section('title', 'Student Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Student</a></li>
    <li class="breadcrumb-item active">Admission</li>
@endsection

@section('content')
    <div class="col-12">

        <!-- Default box -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Student Admission Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{route('students.store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-9">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first_name">First Name *</label>
                                        <input style="height: 30px;" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="first_name"  placeholder="Enter first name" >
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last_name">Last Name *</label>
                                        <input style="height: 30px;" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" id="last_name" placeholder="Enter last name" >
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="student_email">Student Email *</label>
                                        <input style="height: 30px;" type="email" class="form-control" name="student_email" value="{{ old('student_email') }}" id="student_email"  placeholder="Enter first name" >
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
                                        <label for="mobile">Mobile No </label>
                                        <input style="height: 30px;" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" id="mobile" placeholder="">
                                    </div>
                                </div>

                                <div class="col-4">

                                    <div class="form-group">
                                        <label for="student_photo">Photo *</label>
                                        <div class="input-group-sm">
                                            <div class="custom-file">
                                                <input style="height: 30px;" type="file" name="student_photo" class="custom-file-input" id="student_photo">
                                                <label class="custom-file-label" for="student_photo">Browse</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="national_id">Birth Reg. No * </label>
                                        <input style="height: 30px;" type="text" class="form-control" name="national_id" value="{{ old('national_id') }}" id="national_id" placeholder="" >
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

                            </div>
                        </div>

 <!--             Row              -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="session_id">Session *</label>
                                <select class=" form-control select2" id="session_id" name="session_id" style="width: 100%;" >
                                    <option value="">Select one</option>
                                    @foreach($session as $data)
                                        <option value="{{$data->id}}">{{$data->sessions}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="roll_no">Roll No *</label>
                                <input style="height: 30px;" type="text" class="form-control" name="roll_no" value="{{ old('') }}" id="roll_no" placeholder="Enter roll no" >
                            </div>
                            <div class="form-group">
                                <label >Admission Date *</label>
                                <div class="input-group date" id="admission_date"  data-target-input="nearest">
                                    <input style="height: 30px;" type="text" class="form-control datetimepicker-input" name="admission_date" data-target="#date_of_birth"  />
                                    <div class="input-group-append" data-target="#admission_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="student_category_id">Student Category *</label>
                                <select class=" form-control select2" name="student_category_id" id="student_category_id" style="width: 100%;" >
                                    <option value="">Select one</option>
                                    @foreach($category as $data)
                                        <option value="{{$data->id}}">{{$data->student_categorys}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="selectClass">Class * </label>
                                <select class=" form-control select2" name="class_id" id="selectClass" style="width: 100%;"  >
                                    <option value="">Select one</option>
                                    @foreach($class as $data)
                                        <option value="{{$data->id}}">{{$data->classes}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Section *</label>
                                <select class=" form-control select2" name="section_id" id="sectionOption" style="width: 100%;" >
                                    <option value="">Select one</option>
                                </select>
                            </div>
                        </div>

<!--             Row              -->


                        <div class="col-6">
                            <div class="form-group">
                                <label for="previous_school_information">Previous School Information (If any)</label>
                                <input style="height: 30px;" type="text" class="form-control" name="previous_school_information" value="{{ old('previous_school_information') }}" id="previous_school_information" placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="additional_notes">Additional Notes (optional)</label>
                                <input style="height: 30px;" type="text" class="form-control" name="additional_notes" value="{{ old('additional_notes') }}" id="additional_notes" placeholder="">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label for="current_address">Current Address *</label>
                                <input style="height: 30px;" type="text" class="form-control" name="current_address" value="{{ old('current_address') }}" id="current_address" placeholder="" >
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Same Address?</label>
                                <div class="form-check">
                                    <input class="form-check-input" id="same_address" type="checkbox">
                                    <label class="form-check-label">DO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address *</label>
                                <input style="height: 30px;" type="text" class="form-control" name="permanent_address" value="{{ old('permanent_address') }}" id="permanent_address" placeholder="" >
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="form-group">
                                <label for="parents_id">Parent's </label>
                                <select class=" form-control select2" name="parents_id" id="parents_id" style="width: 100%;" >
                                    <option value="">Select parent's</option>
                                    @foreach($parents as $data)
                                        <option value="{{$data->id}}">{{'Father : ' . $data->fathers_name .' , Mother : '. $data->mothers_name .' ,Fathers Mobile : '. $data->fathers_mobile.' , Mothers Mobile : '. $data->mothers_mobile .' , Email : '. $data->user->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="parents_form" class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="fathers_name">Father's Name * </label>
                                    <input style="height: 30px;" type="text" class="form-control" name="fathers_name" value="{{ old('fathers_name') }}" id="fathers_name" placeholder="" >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="fathers_occupation">Father's Occupation * </label>
                                    <input style="height: 30px;" type="text" class="form-control" name="fathers_occupation" value="{{ old('fathers_occupation') }}" id="fathers_occupation" placeholder="" >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="fathers_photo">Photo *</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input style="height: 30px;" type="file" name="fathers_photo" class="custom-file-input" id="fathers_photo">
                                            <label class="custom-file-label" for="fathers_photo">Browse</label>
                                        </div>
                                    </div>
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
                                    <label for="mothers_occupation">Mother's Occupation * </label>
                                    <input style="height: 30px;" type="text" class="form-control" name="mothers_occupation" value="{{ old('mothers_occupation') }}" id="mothers_occupation" placeholder="" >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="mothers_photo">Photo *</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input style="height: 30px;" type="file" name="mothers_photo" class="custom-file-input" id="mothers_photo">
                                            <label class="custom-file-label" for="mothers_photo">Browse</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--             Row              -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="fathers_phone">Father's Phone No * </label>
                                    <input style="height: 30px;" type="text" class="form-control" name="fathers_mobile" value="{{ old('fathers_mobile') }}" id="fathers_phone" placeholder=""  >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="mothers_phone">Mother's Phone No * </label>
                                    <input style="height: 30px;" type="text" class="form-control" name="mothers_mobile" value="{{ old('mothers_mobile') }}" id="mothers_phone" placeholder="">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="parents_email">Email *</label>
                                    <input style="height: 30px;" type="text" class="form-control" name="parents_email" value="{{ old('parents_email') }}" id="parents_email" placeholder=""  >
                                </div>
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
        $('#admission_date').datetimepicker({
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
