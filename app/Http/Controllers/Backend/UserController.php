<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-user|create-user|edit-user|delete-user', ['only' => ['index', 'apiUser']]);
        $this->middleware('permission:create-user', ['only' => ['create']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);

        $this->middleware('role:Administrator|Super Administrator', ['only' => ['assignRoleUser', 'assignRoleUserSubmit']]);
    }
    public function apiUser()
    {
        $data = User::all();

        return Datatables::of($data)->addColumn('action', function ($data){
            return '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu text-right dropdown-menu-right">
                    <button onclick="assignRole('.$data->id.')" class="dropdown-item" type="button">Assign Role</button>
                    <button onclick="editUser('.$data->id.')" class="dropdown-item" type="button">Edit</button>
                    <button onclick="deleteUser('.$data->id.')" class="dropdown-item" type="button">Delete</button>
                </div>
            </div>';

        })->addColumn('role', function ($data){
            $roles =  $data->getRoleNames();
            $r = '|';
            foreach ($roles as $role){
                $r =  $r . $role .' | ';
           }
           return $r;
        })->addIndexColumn()->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.admin.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $input = $request->all();
        if ($input['password']==$input['password_confirmation']){

            $validate = Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if ($validate){
                $data = User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'user_type' => $input['user_type'],
                    'password' => Hash::make($input['password']),
                ]);

                if ($data) {
                    $success = true;
                    $message = "User added successfully";
                } else {
                    $success = false;
                    $message = "Failed!!";
                }
            }else{
                $success = false;
                $message = "Validation failed";
            }
        }else{
            $success = false;
            $message = "Password not matching";
        }


        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $input = $request->all();
        $update = $data->fill($input)->save();
        if ($update) {
            $success = true;
            $message = "User updated successfully";
        } else {
            $success = false;
            $message = "Failed!!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = User::destroy($id);

        if ($delete) {
            $success = true;
            $message = "User deleted successfully";
        } else {
            $success = false;
            $message = "Failed!!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function assignRoleUser($id){
        $user = User::find($id);
        $userRole = $user->getRoleNames();
        $role = Role::all('name');
        return response()->json([
            $role,
            $userRole,
        ]);
    }
    public function assignRoleUserSubmit(Request $request, $id){
        $user = User::find($id);
        $role = $request->roles;
        $sync = $user->syncRoles($role);

        if ($sync) {
            $success = true;
            $message = "Role assigned successfully";
        } else {
            $success = false;
            $message = "Failed!!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function changeStatus($id){
        $user = User::find($id);
        if ($user->active_status == 1) {
            $update=$user->update(['active_status' => '0']);
            return true;
        }else{
            $update=$user->update(['active_status' => '1']);
            return true;
        }

    }
}
