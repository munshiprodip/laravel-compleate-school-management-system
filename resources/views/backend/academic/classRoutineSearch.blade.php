@extends('backend.layouts.main')
@section('title', 'Academic Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Academic</a></li>
    <li class="breadcrumb-item active">Class Routine</li>
@endsection

@section('content')
    <div class="col-12" id="promoteForm">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <select class=" form-control select2" name="pro_class_id" id="pro_selectClass" style="width: 100%;"  >
                        <option value=""> Select Class</option>
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
@endsection

@section('script')
    <script>

        $('#pro_sectionOption').on('change', function () {
            let section_id = $(this).val();
            let class_id = $('#pro_selectClass').val();
            if (section_id!=="" && class_id !== ""){
                //alert('hello')
                let url = 'classroutine'+'/'+class_id+'/'+section_id;
                window.location.href = url;
            }else {
                return false;
            }
        })


        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
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
    </script>
@endsection
