@extends('backend.layouts.main')
@section('title', 'Student Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Student</a></li>
    <li class="breadcrumb-item active">Promote</li>
@endsection

@section('content')
    <div class="col-6">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <select class=" form-control select2" name="class_id" id="selectClass" style="width: 100%;"  >
                        <option value="">Select Class</option>
                        @foreach($class as $data)
                            <option value="{{$data->id}}">{{$data->classes}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select class=" form-control select2" name="section_id" id="sectionOption" style="width: 100%;" >
                        <option value="">Select Section</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6" id="promoteForm">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <select class=" form-control select2" name="pro_class_id" id="pro_selectClass" style="width: 100%;"  >
                        <option value="">Promote to Class</option>
                        @foreach($class as $data)
                            <option value="{{$data->id}}">{{$data->classes}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select class=" form-control select2" name="section_id" id="pro_sectionOption" style="width: 100%;" >
                        <option value="">Select Section</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <form id="promoteStudent" method="POST">
            <!-- Default box -->
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title"> Student List</h3>
                    <input class="btn btn-primary float-right" id="submit_btn" type="submit" value="Promote">
                </div>
                <div class="card-body">
                    <table id="studentTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="10px">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input id="check_all" class="form-check-input" type="checkbox">
                                    </div>
                                </div>
                            </th>
                            <th width="100px">Photo</th>
                            <th width="40%">Name</th>
                            <th width="15%">Admission No</th>
                            <th width="15%">Roll No</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>

    </div>
@endsection

@section('script')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
            $('#submit_btn').hide();
        })

        $('#selectClass').on('change', function () {
            let id = $(this).val();
            if (id!==""){
                $.ajax({
                    url: "{{url('/classes/section')}}"+'/'+id,
                    type: "GET",
                    dataType:"JSON",
                    success:function (data) {
                        $("#sectionOption").empty()
                        $("#sectionOption").append('<option value="">Select Section</option>')
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
                $("#sectionOption").append('<option value="">Select Section</option>')
            }
        })

        $('#pro_selectClass').on('change', function () {
            let id = $(this).val();
            if (id!==""){
                $.ajax({
                    url: "{{url('/classes/section')}}"+'/'+id,
                    type: "GET",
                    dataType:"JSON",
                    success:function (data) {
                        $("#pro_sectionOption").empty()
                        $("#pro_sectionOption").append('<option value="">Select Section</option>')
                        let i;
                        for (i = 0; i < data[0].length; ++i) {
                            $("#pro_sectionOption").append('<option value="'+data[0][i].id+'">'+data[0][i].sections+'</option>');
                        }
                    },
                    error: function () {
                        alert('Oops!!!');
                    }

                })
            }else {
                $("#pro_sectionOption").empty()
                $("#pro_sectionOption").append('<option value="">Select Section</option>')
            }
        })


        $('#pro_sectionOption').on('change', function () {
            let id = $(this).val();
            if (id!==""){
                $('#submit_btn').show();
            }else {
                $('#submit_btn').hide();
            }
        })


        let table =    $("#studentTable").DataTable({
            "paging":   false,
            "ordering": false,
            "searching": false,
            "info":     false
        });

        $('#sectionOption').on('change', function () {

            let section_id = $(this).val();
            let class_id = $('#selectClass').val();
            if (class_id!=="" && class_id){
                table.destroy();
                table =    $("#studentTable").DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ordering: false,
                    lengthChange: false,
                    ajax: "{{url('/student/api')}}"+'/'+class_id+'/'+section_id,
                    columns: [

                        {data: function (data) {
                                return '<div class="form-group"><div class="form-check"><input name="student_ids" value="'+data.id+'" class="form-check-input" type="checkbox"></div></div>'
                            }},
                        {data: function (data) {
                                return '<img style="width: 50px;" src="{{ asset('storage/images/students/')}}'+'/'+data.student_photo+'">'
                        }},
                        {data:'full_name'},
                        {data:'admission_no'},
                        {data:'roll_no'},
                    ]
                });
            }else {
                $("#studentTable").empty()
            }
        })

        $("#check_all").change(function() {
            if(this.checked) {
                $(".form-check-input").prop('checked', true);
            }else {
                $(".form-check-input").prop('checked', false);
            }
        });

        $(function () {
            $('#promoteStudent').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    let csrf_token =$('meta[name="csrf-token"]').attr('content');

                   // var student_id = $('input[name="student_ids"]:checked').serialize();

                    var student_id = new Array();
                    $('input[name="student_ids"]:checked').each(function() {
                        student_id.push(this.value);
                    });


                    $.ajax({
                        url: "{{route('promoteStudentsSubmit')}}",
                        type: "POST",
                        //data: $('#promoteStudent').serialize(),
                        data: {'_token': csrf_token, 'student_id': student_id, 'class_id': $('#pro_selectClass').val(), 'section_id': $("#pro_sectionOption").val() },
                        success:function (data) {
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

                            table.ajax.reload();

                        },
                        error: function () {
                            alert('Oops!!!');
                        }
                    });
                    return false;
                }
            });
        })

    </script>
@endsection


