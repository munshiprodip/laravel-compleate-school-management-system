var table =    $("#bloodTable").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    lengthChange: false,
    ajax: "{{route('api.bloodgroup')}}",
    columns: [
        {data:'DT_RowIndex'},
        {data:'bloodgroups'},
        {data:'action'},
    ]
});

function addBlood() {
    $("#addBlood").modal('show');
}

$(function () {
    $('#addBlood form').on('submit', function (e) {
        $('#addBlood form')[0].reset();
        if (!e.isDefaultPrevented()){
            $.ajax({
                url: "{{route('create.bloodgroup')}}",
                type: "POST",
                data: $('#addBlood form').serialize(),
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

                    $('#addBlood').modal('hide');
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

function editBlood(id) {
    $('#editBlood form')[0].reset();
    $.ajax({
        url: "{{url('bloodgroup')}}"+'/'+id+'/edit',
        type: "GET",
        dataType:"JSON",
        success:function (data) {
            $('#id').val(data.id);
            $('#bloodgroups').val(data.bloodgroups);
            $('#editBlood').modal('show');
        },
        error: function () {
            alert('Oops!!!');
        }

    })
}

$(function () {
    $('#editBlood form').on('submit', function (e) {
        if (!e.isDefaultPrevented()){
            var id = $('#id').val();
            $.ajax({
                url: "{{url('bloodgroup')}}"+'/'+id,
                type: "POST",
                data: $('#editBlood form').serialize(),
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

                    $('#editBlood').modal('hide');
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

function deleteBlood(id) {

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
                url: "{{url('bloodgroup')}}"+'/'+id+'/delete',
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
