@extends('backend.layouts.main')
@section('title', 'User Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">User</li>
@endsection

@section('content')
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title"><span><a onclick="addUser()" href="#" class="btn btn-outline-info">ADD </button></a></span> User</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="userTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="20%">Name</th>
                        <th width="20%">Email</th>
                        <th width="15%">Type</th>
                        <th width="10%">Status</th>
                        <th width="15%">Role</th>
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
    <div class="modal fade" id="addUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input  type="text" class="form-control" name="name" placeholder="Enter Name" required autofocus>
                            <br/>
                            <input  type="email" class="form-control " name="email" placeholder="Enter Email" required>
                            <br/>
                            <input  type="password" class="form-control " name="password" placeholder="Enter Password" required >
                            <br/>
                            <input  type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password" required >
                            <br/>
                            <select class="form-control" name="user_type">
                                <option value="">Select User Type</option>
                                <option value="Employee">Employee</option>
                                <option value="Student">Student</option>
                                <option value="Parent">Parent</option>
                            </select>
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
    <div class="modal fade" id="editUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input id="name" type="text" class="form-control" name="name" placeholder="Enter Name" required autofocus>
                            <br/>
                            <input id="email" type="email" class="form-control " name="email"  required autocomplete="email">
                            <br/>
                            <select id="user_type" class="form-control" name="user_type">
                                <option value="">Select User Type</option>
                                <option value="Employee">Employee</option>
                                <option value="Student">Student</option>
                                <option value="Parent">Parent</option>
                            </select>

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
    <div class="modal  fade " id="assignRole">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Assign Role </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group" id="roleInputDiv">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="hidden" id="userId" value="">
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
        var table =    $("#userTable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ajax: "{{route('api.user')}}",
            columns: [
                {data:'DT_RowIndex'},
                {data:'name'},
                {data:'email'},
                {data:'user_type'},
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
                {data:'role'},
                {data:'action'},
            ]
        });

        function addUser() {
            $('#addUser form')[0].reset();
            $("#addUser").modal('show');
        }

        $(function () {
            $('#addUser form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    $.ajax({
                        url: "{{url('create.user')}}",
                        type: "POST",
                        data: $('#addUser form').serialize(),
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

                            $('#addUser').modal('hide');
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


        function assignRole(id){
            $('#assignRole form')[0].reset();
            $.ajax({
                url: "{{url('user/role')}}"+'/'+id,
                type: "GET",
                dataType:"JSON",
                success:function (data) {
                    $("#roleInputDiv").empty()
                    let i;
                    let checkRole = '';
                    for (i = 0; i < data[0].length; ++i) {
                        if( $.inArray(data[0][i].name, data[1]) !== -1 ){
                            checkRole = 'checked';
                        }else{
                            checkRole = '';
                        }
                        $("#roleInputDiv").append('<div class="form-check"><input class="form-check-input" '+checkRole+' value="'+data[0][i].name+'" name="roles[]" type="checkbox"><label class="form-check-label">'+data[0][i].name+'</label></div>');
                    }
                    $('#userId').val(id);
                    $('#assignRole').modal('show');
                },
                error: function () {
                    alert('Oops!!!');
                }

            })
        }

        $(function () {
            $('#assignRole form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    let id = $('#userId').val();
                    $.ajax({
                        url: "{{url('user/role/assign')}}"+'/'+id,
                        type: "PATCH",
                        data: $('#assignRole form').serialize(),
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

                            $('#assignRole').modal('hide');
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

        function editUser(id) {
            $('#editUser form')[0].reset();
            $.ajax({
                url: "{{url('user')}}"+'/'+id+'/edit',
                type: "GET",
                dataType:"JSON",
                success:function (data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#user_type').val(data.user_type);
                    $('#editUser').modal('show');
                },
                error: function () {
                    alert('Oops!!!');
                }

            })
        }

        $(function () {
            $('#editUser form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    $.ajax({
                        url: "{{url('user')}}"+'/'+id,
                        type: "POST",
                        data: $('#editUser form').serialize(),
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

                            $('#editUser').modal('hide');
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

        function deleteUser(id) {

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
                        url: "{{url('user')}}"+'/'+id+'/delete',
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
                    var url = "{{url('user/status/change')}}"+'/'+id;
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

    </script>

@endsection

