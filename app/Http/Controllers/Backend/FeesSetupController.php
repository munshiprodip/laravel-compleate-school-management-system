<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpClass;
use App\Models\EpFeesSetup;
use App\Models\EpFeesType;
use App\Models\EpStudent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FeesSetupController extends Controller
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

    public function apiFeesSetup()
    {
        $data = EpFeesSetup::all();

        return Datatables::of($data)->addColumn('action',function ($data){
            return '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu text-right dropdown-menu-right">
                    <button onclick="editData('.$data->id.')" class="dropdown-item" type="button">Edit</button>
                    <button onclick="deleteData('.$data->id.')" class="dropdown-item" type="button">Delete</button>
                    <a href="'.route('assignFees', $data->id).'" class="dropdown-item">Assign Fees</a>
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
        $types = EpFeesType::all();
        return view('backend.accounts.fees.setup', compact('types'));
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
        $data = EpFeesSetup::create($input);

        if ($data) {
            $success = true;
            $message = "Fees setup successfully";
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
        $data = EpFeesSetup::find($id);
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
        $data = EpFeesSetup::find($id);
        $input = $request->all();
        $update = $data->fill($input)->save();
        if ($update) {
            $success = true;
            $message = "Fees setup updated successfully";
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
        $delete = EpFeesSetup::destroy($id);

        if ($delete) {
            $success = true;
            $message = "Fees setup Deleted successfully";
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
        $data = EpFeesSetup::find($id);
        if ($data->active_status == 1) {
            $update=$data->update(['active_status' => '0']);
            return true;
        }else{
            $update=$data->update(['active_status' => '1']);
            return true;
        }

    }
    public function assignFees($fees_id){
        $class = EpClass::all();
        return view('backend.accounts.fees.assign', compact('class', 'fees_id'));
    }

    public function studentApi($class_id, $section_id, $fees_id){

        $student_ids = EpFeesSetup::find($fees_id)->assignedStudent()->allRelatedIds()->toArray();

        $data = EpStudent::whereNotIn('id', $student_ids)->where('class_id', $class_id)->where('section_id', $section_id)->where('active_status', 1)->get();

        return Datatables::of($data)->toJson();
    }

    public function assignFeesSubmit(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'student_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please select students',
            ]);
        }

        $ids = $request['student_id'];
        $fees = EpFeesSetup::find($id);
        $assign = $fees->assignedStudent()->attach($ids);

        if ($assign == null) {
            $success = true;
            $message = "Fees assigned successfully";
        } else {
            $success = false;
            $message = "Failed!!";
        }

        //  Return response
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
    public function collectFees(){
        $class = EpClass::all();
        return view('backend.accounts.fees.collect', compact('class'));
    }

}
