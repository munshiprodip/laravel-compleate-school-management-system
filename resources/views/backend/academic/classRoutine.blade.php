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

    <div class="col-12">

        <!-- Default box -->
        <div class="card card-dark">
            <div class="card-header">

                <h3 class="card-title">Class Routine</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="classroutineTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="12%">Period</th>
                        <th width="12%">Saturday</th>
                        <th width="12%">Sunday</th>
                        <th width="12%">Monday</th>
                        <th width="12%">Tuesday</th>
                        <th width="12%">Wednesday</th>
                        <th width="12%">Thursday</th>
                        <th>Friday</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($period as $p)
                        <?php $p_id = $p->id;?>
                        <tr>
                            <td>
                                {{$p->name}} <br/>
                                {{$p->start}} -
                                {{$p->end}}
                            </td>

                            @for($i=1; $i<7; $i++)
                                <td>
                                    @php
                                        $routine = \App\Models\EpClassroutine::select("*")
                                                    ->where("day", $i)
                                                    ->where("class_id", $class_id)
                                                    ->where("section_id", $section_id)
                                                    ->where("period_id", $p->id)
                                                    ->get()
                                                    ->first();;
                                    @endphp
                                    @if($routine)
                                        {{$routine->subjects->subjects}}<br/>
                                        {{$routine->teachers->full_name}}<br/>
                                        {{$routine->classrooms->name}}<br/>

                                        <a href="#editRoutine{{$i.$p->id}}" data-toggle="modal" class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete({{$routine->id}})" class="btn btn-xs btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>





                                        <form id="deletForm{{$routine->id}}" action="{{route('classroutine.destroy', $routine->id)}}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                        </form>




                                        <div class="modal fade" id="editRoutine{{$i.$p->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{route('classroutine.update',$routine->id )}}" >
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Routine ({{$p->name}})</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="subject_id">Subject *</label>
                                                                <select class=" form-control select2" name="subject_id" >
                                                                    <option value="">Select one</option>
                                                                    @foreach($subjects as $data)
                                                                        <option {{($routine->subject_id==$data->id)? 'selected':''}} value="{{$data->id}}">{{$data->subjects}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="teacher_id">Teacher *</label>
                                                                <select class=" form-control select2" name="teacher_id" >
                                                                    <option value="">Select one</option>
                                                                    @foreach($teachers as $data)
                                                                        <option {{($routine->teacher_id==$data->id)? 'selected':''}} value="{{$data->id}}">{{$data->full_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="room_id">Teacher *</label>
                                                                <select class=" form-control select2" name="room_id" >
                                                                    <option value="">Select one</option>
                                                                    @foreach($rooms as $data)
                                                                        <option {{($routine->room_id==$data->id)? 'selected':''}} value="{{$data->id}}">{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="class_id" value="{{ $routine->class_id }}">
                                                            <input type="hidden" name="section_id" value="{{ $routine->section_id }}">
                                                            <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                                                            <input type="submit" class="btn btn-primary" value="Submit">
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                    @else
                                        <a href="#addRoutine{{$i.$p->id}}" data-toggle="modal" class="btn btn-outline-primary">
                                            <i class="fas fa-plus"></i>
                                        </a>

                                        <div class="modal fade" id="addRoutine{{$i.$p->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{route('classroutine.store')}}" >
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Routine ({{$p->name}})</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="subject_id">Subject *</label>
                                                                <select class=" form-control select2" name="subject_id" >
                                                                    <option value="">Select one</option>
                                                                    @foreach($subjects as $data)
                                                                        <option value="{{$data->id}}">{{$data->subjects}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="teacher_id">Teacher *</label>
                                                                <select class=" form-control select2" name="teacher_id" >
                                                                    <option value="">Select one</option>
                                                                    @foreach($teachers as $data)
                                                                        <option value="{{$data->id}}">{{$data->full_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="room_id">Teacher *</label>
                                                                <select class=" form-control select2" name="room_id" >
                                                                    <option value="">Select one</option>
                                                                    @foreach($rooms as $data)
                                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="class_id" value="{{$class_id}}">
                                                            <input type="hidden" name="section_id" value="{{$section_id}}">
                                                            <input type="hidden" name="day" value="{{$i}}">
                                                            <input type="hidden" name="period_id" value="{{$p->id}}">
                                                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                                            <input type="submit" class="btn btn-primary" value="Submit">
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endif
                                </td>
                            @endfor
                            <td>Weekend</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection

@section('script')
<script>

    $('#pro_sectionOption').on('change', function () {
        let section_id = $(this).val();
        let class_id = $('#pro_selectClass').val();
        if (section_id!=="" && class_id !== ""){
            //alert('hello')
            let url = '/school/classroutine'+'/'+class_id+'/'+section_id;
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

    function confirmDelete(id){
        swal.fire({
            title: "Delete Student?",
            text: "Please ensure and then confirm!",
            showCancelButton: !0,
            confirmButtonText: "Yes, Delete!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then( function (e) {
            if (e.value === true){
                $('#deletForm'+id).submit();
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    }
</script>
@endsection
