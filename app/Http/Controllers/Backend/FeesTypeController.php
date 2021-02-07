<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpFeesType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FeesTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-bloodgroup|create-bloodgroup|edit-bloodgroup|delete-bloodgroup', ['only' => ['index', 'apiBlodgroup']]);
        $this->middleware('permission:create-bloodgroup', ['only' => ['create']]);
        $this->middleware('permission:edit-bloodgroup', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-bloodgroup', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Exception
     */

    public function apiFeesType()
    {
        $data = EpFeesType::all();

        return Datatables::of($data)->addColumn('action',function ($data){
            return '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu text-right dropdown-menu-right">
                    <button onclick="editData('.$data->id.')" class="dropdown-item" type="button">Edit</button>
                    <button onclick="deleteData('.$data->id.')" class="dropdown-item" type="button">Delete</button>
                </div>
            </div>';

        })->addIndexColumn()->toJson();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.accounts.fees.type');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $data = EpFeesType::create($input);

        if ($data) {
            $success = true;
            $message = "Fees type added successfully";
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
        $data = EpFeesType::find($id);
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
        $data = EpFeesType::find($id);
        $input = $request->all();
        $update = $data->fill($input)->save();
        if ($update) {
            $success = true;
            $message = "Fees type updated successfully";
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
        $delete = EpFeesType::destroy($id);

        if ($delete) {
            $success = true;
            $message = "Fees type Deleted successfully";
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
        $data = EpFeesType::find($id);
        if ($data->active_status == 1) {
            $update=$data->update(['active_status' => '0']);
            return true;
        }else{
            $update=$data->update(['active_status' => '1']);
            return true;
        }

    }
}
