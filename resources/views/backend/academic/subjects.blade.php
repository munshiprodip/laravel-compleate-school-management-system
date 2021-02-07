@extends('backend.layouts.main')
@section('title', 'Academic Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Academic</a></li>
    <li class="breadcrumb-item active">Subject</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title"><span><a onclick="addSubject()" href="#" class="btn btn-outline-info">ADD </button></a></span> Subject</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="subjectTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="30%">Subject</th>
                        <th width="15%">Type</th>
                        <th width="15%">Class</th>
                        <th width="15%">Section</th>
                        <th width="15%">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <!-- Modal for Add Blood Group -->
    <div class="modal fade" id="addSubject">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Subject</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="subjects" placeholder="Subject Name" class="form-control" required autofocus >
                            <br/>
                            <select name="subject_type" class="form-control select2" required>
                                <option value="">Select Subject Type</option>
                                <option value="Theory">Theory</option>
                                <option value="Practical">Practical</option>
                                <option value="Theory & Practical">Theory & Practical</option>
                            </select>
                            <br/>
                            <select name="class_id" class="form-control select2" id="selectClass" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $data)
                                    <option value="{{$data->id}}">{{$data->classes}}</option>
                                @endforeach
                            </select>
                            <br/>
                            <select name="section_id" class="form-control select2" id="sectionOption" required>
                            </select>

                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="reset" class="btn btn-default" >Clear</button>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal for Edit Blood Group -->
    <div class="modal fade" id="editSubject">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Subject</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="subjects" name="subjects" class="form-control" required>

                            <br/>
                            <select name="subject_type" id="subject_type" class="form-control select2" required>
                                <option value="Theory">Theory</option>
                                <option value="Practical">Practical</option>
                                <option value="Theory & Practical">Theory & Practical</option>
                            </select>
                            <br/>
                            <select name="class_id" id="selectClassEdit" class="form-control select2" required>
                                @foreach($classes as $data)
                                    <option value="{{$data->id}}">{{$data->classes}}</option>
                                @endforeach
                            </select>
                            <br/>
                            <select name="section_id" class="form-control select2" id="sectionOptionEdit" required>
                                @foreach($sections as $data)
                                    <option value="{{$data->id}}">{{$data->sections}}</option>
                                @endforeach

                            </select>

                            <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Update">
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
        var table =    $("#subjectTable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ajax: "{{route('api.subject')}}",
            columns: [
                {data:'DT_RowIndex'},
                {data:'subjects'},
                {data:'subject_type'},
                {data: 'classes'},
                {data: 'sections'},
                {data: function (data) {
                        if (data.active_status == 1){
                            var chk = 'checked';
                            var st = 'Active';
                        }else {
                            var chk = '';
                            var st = 'Deactive';

                        }
                        return '<div class="custom-control custom-switch"><input type="checkbox" onchange="changeStatus('+data.id+')" '+chk+' class="custom-control-input" id="customSwitch'+data.id+'"><label class="custom-control-label" for="customSwitch'+data.id+'">'+st+'</label></div>'
                    }},
                {data:'action'},
            ]
        });
        $('#selectClass').on('change', function () {
            let id = $(this).val();
            if (id!==""){
                $.ajax({
                    url: "http://192.168.31.20/school/classes/section"+'/'+id,
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
                $("#sectionOption").append('<option value="">Select one</option>')
            }
        })

        function addSubject() {
            $('#addSubject form')[0].reset();
            $("#addSubject").modal('show');
        }

        $(function () {
            $('#addSubject form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    $.ajax({
                        url: "{{route('create.subject')}}",
                        type: "POST",
                        data: $('#addSubject form').serialize(),
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

                            $('#addSubject').modal('hide');
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


        function editSubject(id) {
            $('#editSubject form')[0].reset();
            $.ajax({
                url: "{{url('subject')}}"+'/'+id+'/edit',
                type: "GET",
                dataType:"JSON",
                success:function (data) {
                    $('#id').val(data.id);
                    $('#subjects').val(data.subjects);
                    $('#subject_type').val(data.subject_type);
                    $('#selectClassEdit').val(data.class_id);
                    $('#sectionOptionEdit').val(data.section_id);
                    $('#editSubject').modal('show');
                },
                error: function () {
                    alert('Oops!!!');
                }

            })
        }

        $(function () {
            $('#editSubject form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    $.ajax({
                        url: "{{url('subject')}}"+'/'+id,
                        type: "POST",
                        data: $('#editSubject form').serialize(),
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

                            $('#editSubject').modal('hide');
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

        function deleteSubject(id) {

            swal.fire({
                title: "Delete?",
                text: "Please ensure and then confirm!",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then( function (e) {
                if (e.value === true){
                    var csrf_token =$('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{url('subject')}}"+'/'+id+'/delete',
                        type: "POST",
                        data:{'_method': 'DELETE', '_token': csrf_token},
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

                    })
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })

        }

        function changeStatus(id){
            swal.fire({
                title: "Change Status?",
                text: "Please ensure and then confirm!",
                showCancelButton: !0,
                confirmButtonText: "Yes, change!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then( function (e) {
                if (e.value === true){
                    var url = "{{url('subject/status/change')}}"+'/'+id;
                    $.ajax({
                        url:url,
                        type:"GET",
                        dataType:"JSON",
                        success: function (data){
                            table.ajax.reload();
                        },
                        error: function (){
                            alert('Error');
                        }
                    });
                } else {
                    table.ajax.reload();
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }

        $(document).ready(function () {
            bsCustomFileInput.init();
        });

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })



    </script>
@endsection
