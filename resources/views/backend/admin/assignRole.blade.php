@extends('backend.layouts.main')
@section('title', 'Admin Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Assign Role</li>
@endsection

@section('content')


    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <h1 style="font-size: 20px;color: #000;">Assign permission for <span style="font-weight: bold;color: #16b7dc;">{{$role->name}}</span> Role</h1>
            </div>
            <div class="col-4">
                <button id="saveForm" type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </div>
    <div class="col-12" id="permissionForm">
        <form role="form" method="post" action="{{route('assignRoleUpdate',$role->id)}}">
            @csrf
            @method('PATCH')
        <div class="row">
            <div class="col-3">
                <!-- Default box -->
                <div class="card card-outline card-primary collapsed-card">
                    <div class="card-header">
                        <?php
                        $blood_create = in_array('create-bloodgroup', $permissions)? 'fas': 'far';
                        $blood_read = in_array('read-bloodgroup', $permissions)? 'fas': 'far';
                        $blood_edit = in_array('edit-bloodgroup', $permissions)? 'fas': 'far';
                        $blood_delete = in_array('delete-bloodgroup', $permissions)? 'fas': 'far';

                        $religion_create = in_array('create-religion', $permissions)? 'fas': 'far';
                        $religion_read = in_array('read-religion', $permissions)? 'fas': 'far';
                        $religion_edit = in_array('edit-religion', $permissions)? 'fas': 'far';
                        $religion_delete = in_array('delete-religion', $permissions)? 'fas': 'far';

                        $gender_create = in_array('create-gender', $permissions)? 'fas': 'far';
                        $gender_read = in_array('read-gender', $permissions)? 'fas': 'far';
                        $gender_edit = in_array('edit-gender', $permissions)? 'fas': 'far';
                        $gender_delete = in_array('delete-gender', $permissions)? 'fas': 'far';

                        $role_create = in_array('create-role', $permissions)? 'fas': 'far';
                        $role_read = in_array('read-role', $permissions)? 'fas': 'far';
                        $role_edit = in_array('edit-role', $permissions)? 'fas': 'far';
                        $role_delete = in_array('delete-role', $permissions)? 'fas': 'far';

                        $permission_create = in_array('create-permission', $permissions)? 'fas': 'far';
                        $permission_read = in_array('read-permission', $permissions)? 'fas': 'far';
                        $permission_edit = in_array('edit-permission', $permissions)? 'fas': 'far';
                        $permission_delete = in_array('delete-permission', $permissions)? 'fas': 'far';
                        ?>
                        <h3 class="card-title"> Bloodgroup </h3>
                        <span >

                        </span>
                        <div class="card-tools ">
                            <i class="{{$blood_create}} fa-circle text-info"></i>
                            <i class="{{$blood_read}} fa-circle text-info"></i>
                            <i class="{{$blood_edit}} fa-circle text-info"></i>
                            <i class="{{$blood_delete}} fa-circle text-info"></i>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'create-bloodgroup') @php $blood_class='text-warning'; @endphp checked @endif @endforeach value="create-bloodgroup" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'read-bloodgroup') checked @endif @endforeach value="read-bloodgroup" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Read</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'edit-bloodgroup') checked @endif @endforeach value="edit-bloodgroup" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'delete-bloodgroup') checked @endif @endforeach value="delete-bloodgroup" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline card-primary collapsed-card">
                    <div class="card-header">

                        <h3 class="card-title"> Religion </h3>

                        <div class="card-tools">
                            <i class="{{$religion_create}} fa-circle text-info"></i>
                            <i class="{{$religion_read}} fa-circle text-info"></i>
                            <i class="{{$religion_edit}} fa-circle text-info"></i>
                            <i class="{{$religion_delete}} fa-circle text-info"></i>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'create-religion') checked @endif @endforeach value="create-religion" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'read-religion') checked @endif @endforeach value="read-religion" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Read</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'edit-religion') checked @endif @endforeach value="edit-religion" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'delete-religion') checked @endif @endforeach value="delete-religion" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline card-primary collapsed-card">
                    <div class="card-header">

                        <h3 class="card-title"> Gender </h3>

                        <div class="card-tools">
                            <i class="{{$gender_create}} fa-circle text-info"></i>
                            <i class="{{$gender_read}} fa-circle text-info"></i>
                            <i class="{{$gender_edit}} fa-circle text-info"></i>
                            <i class="{{$gender_delete}} fa-circle text-info"></i>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'create-gender') checked @endif @endforeach value="create-gender" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'read-gender') checked @endif @endforeach value="read-gender" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Read</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'edit-gender') checked @endif @endforeach value="edit-gender" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'delete-gender') checked @endif @endforeach value="delete-gender" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline card-primary collapsed-card">
                    <div class="card-header">

                        <h3 class="card-title"> Role </h3>

                        <div class="card-tools">
                            <i class="{{$role_create}} fa-circle text-info"></i>
                            <i class="{{$role_read}} fa-circle text-info"></i>
                            <i class="{{$role_edit}} fa-circle text-info"></i>
                            <i class="{{$role_delete}} fa-circle text-info"></i>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'create-role') checked @endif @endforeach value="create-role" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'read-role') checked @endif @endforeach value="read-role" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Read</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'edit-role') checked @endif @endforeach value="edit-role" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'delete-role') checked @endif @endforeach value="delete-role" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline card-primary collapsed-card">
                    <div class="card-header">

                        <h3 class="card-title"> Permission </h3>

                        <div class="card-tools">
                            <i class="{{$permission_create}} fa-circle text-info"></i>
                            <i class="{{$permission_read}} fa-circle text-info"></i>
                            <i class="{{$permission_edit}} fa-circle text-info"></i>
                            <i class="{{$permission_delete}} fa-circle text-info"></i>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'create-permission') checked @endif @endforeach value="create-permission" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'read-permission') checked @endif @endforeach value="read-permission" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Read</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'edit-permission') checked @endif @endforeach value="edit-permission" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @foreach($permissions as $v) @if($v == 'delete-permission') checked @endif @endforeach value="delete-permission" name="permission[]" type="checkbox">
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->
            </div>
        </div>
        </form>
    </div>



@endsection

@section('script')
    <script type="text/javascript">
        $('#saveForm').on('click', function (){
            $('#permissionForm form').submit();
        })
    </script>
@endsection

