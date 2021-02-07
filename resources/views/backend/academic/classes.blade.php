@extends('backend.layouts.main')
@section('title', 'Academic Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Academic</a></li>
    <li class="breadcrumb-item active">Class</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title"><span><a onclick="addClass()" href="#" class="btn btn-outline-info">ADD </button></a></span> Class</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="classTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="40%">Class</th>
                        <th width="20%">Sections</th>
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
    <div class="modal fade" id="addClass">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Class</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="classes" class="form-control" required autofocus >
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <div class="modal fade" id="editClass">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Class</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="classes" name="classes" class="form-control" required>
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

    <!-- Modal for Assign Role Group -->
    <div class="modal  fade " id="assignSection">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Assign Section </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group" id="sectionInputDiv">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="hidden" id="classId" value="">
                        <input type="submit" class="btn btn-primary" value="Save">
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
        var table =    $("#classTable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ajax: "{{route('api.class')}}",
            columns: [
                {data:'DT_RowIndex'},
                {data:'classes'},
                //{data:'sections'},
                {data: function (data) {
                        if (data.sections == '|'){
                            var sections = '';
                        }else {
                            var sections = data.sections;
                        }
                        return sections;
                    }},
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

        function addClass() {
            $('#addClass form')[0].reset();
            $("#addClass").modal('show');
        }

        $(function () {
            $('#addClass form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    $.ajax({
                        url: "{{route('create.class')}}",
                        type: "POST",
                        data: $('#addClass form').serialize(),
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

                            $('#addClass').modal('hide');
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


        function editClass(id) {
            $('#editClass form')[0].reset();
            $.ajax({
                url: "{{url('class')}}"+'/'+id+'/edit',
                type: "GET",
                dataType:"JSON",
                success:function (data) {
                    $('#id').val(data.id);
                    $('#classes').val(data.classes);
                    $('#editClass').modal('show');
                },
                error: function () {
                    alert('Oops!!!');
                }

            })
        }

        $(function () {
            $('#editClass form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    $.ajax({
                        url: "{{url('class')}}"+'/'+id,
                        type: "POST",
                        data: $('#editClass form').serialize(),
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

                            $('#editClass').modal('hide');
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

        function deleteClass(id) {

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
                        url: "{{url('class')}}"+'/'+id+'/delete',
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
                    var url = "{{url('class/status/change')}}"+'/'+id;
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

        function assignSection(id){
            $('#assignSection form')[0].reset();
            $.ajax({
                url: "{{url('class/section')}}"+'/'+id,
                type: "GET",
                dataType:"JSON",
                success:function (data) {
                    console.log(data);
                   $("#sectionInputDiv").empty()
                    let i;
                    let checkSection = '';
                    for (i = 0; i < data[0].length; ++i) {
                        if( $.inArray(data[0][i].sections, data[1]) !== -1 ){
                            checkSection = 'checked';
                        }else{
                            checkSection = '';
                        }
                        $("#sectionInputDiv").append('<div class="form-check"><input class="form-check-input" '+checkSection+' value="'+data[0][i].id+'" name="sections[]" type="checkbox"><label class="form-check-label">'+data[0][i].sections+'</label></div>');
                    }
                    $('#classId').val(id);
                    $('#assignSection').modal('show');


                },
                error: function () {
                    alert('Oops!!!');
                }

            })
        }

        $(function () {
            $('#assignSection form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    let id = $('#classId').val();
                    $.ajax({
                        url: "{{url('/class/section/assign')}}"+'/'+id,
                        type: "PATCH",
                        data: $('#assignSection form').serialize(),
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

                            $('#assignSection').modal('hide');
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


        $(document).ready(function () {
            bsCustomFileInput.init();
        });

    </script>
@endsection

