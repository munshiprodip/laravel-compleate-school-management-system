@extends('backend.layouts.main')
@section('title', 'Academic Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Academic</a></li>
    <li class="breadcrumb-item active">Session</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title"><span><a onclick="addSession()" href="#" class="btn btn-outline-info">ADD </button></a></span> Session</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="sessionTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="60%">Session</th>
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
    <div class="modal fade" id="addSession">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Session</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="sessions" class="form-control" required autofocus >
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
    <div class="modal fade" id="editSession">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Session</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="sessions" name="sessions" class="form-control" required>
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
        var table =    $("#sessionTable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ajax: "{{route('api.session')}}",
            columns: [
                {data:'DT_RowIndex'},
                {data:'sessions'},
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

        function addSession() {
            $('#addSession form')[0].reset();
            $("#addSession").modal('show');
        }

        $(function () {
            $('#addSession form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    $.ajax({
                        url: "{{route('create.session')}}",
                        type: "POST",
                        data: $('#addSession form').serialize(),
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

                            $('#addSession').modal('hide');
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


        function editSession(id) {
            $('#editSession form')[0].reset();
            $.ajax({
                url: "{{url('session')}}"+'/'+id+'/edit',
                type: "GET",
                dataType:"JSON",
                success:function (data) {
                    $('#id').val(data.id);
                    $('#sessions').val(data.sessions);
                    $('#editSession').modal('show');
                },
                error: function () {
                    alert('Oops!!!');
                }

            })
        }

        $(function () {
            $('#editSession form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    $.ajax({
                        url: "{{url('session')}}"+'/'+id,
                        type: "POST",
                        data: $('#editSession form').serialize(),
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

                            $('#editSession').modal('hide');
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

        function deleteSession(id) {

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
                        url: "{{url('session')}}"+'/'+id+'/delete',
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
                    var url = "{{url('session/status/change')}}"+'/'+id;
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

    </script>
@endsection
