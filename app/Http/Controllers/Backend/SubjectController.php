<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpClass;
use App\Models\EpSection;
use App\Models\EpSubject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:read-subject|create-subject|edit-subject|delete-subject', ['only' => ['index', 'apiBlodgroup']]);
        $this->middleware('permission:create-subject', ['only' => ['create']]);
        $this->middleware('permission:edit-subject', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-subject', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Exception
     */

    public function apiSubject()
    {
        $data = EpSubject::all();

        return Datatables::of($data)->addColumn('action',function ($data){
            return '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu text-right dropdown-menu-right">
                    <button onclick="editSubject('.$data->id.')" class="dropdown-item" type="button">Edit</button>
                    <button onclick="deleteSubject('.$data->id.')" class="dropdown-item" type="button">Delete</button>
                </div>
            </div>';

        })->addColumn('classes', function ($data){
            return $data->classes->classes;
        })->addColumn('sections', function ($data){
            return $data->sections->sections;
        })->addIndexColumn()->toJson();
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     * @throws \Exception
     */

    public function index()
    {
        $classes = EpClass::all();
        $sections = EpSection::all();
        return view('backend.academic.subjects', compact('classes', 'sections'));
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
        $data = EpSubject::create($input);

        if ($data) {
            $success = true;
            $message = "Subject added successfully";
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = EpSubject::find($id);
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
        $data = EpSubject::find($id);
        $input = $request->all();
        $update = $data->fill($input)->save();
        if ($update) {
            $success = true;
            $message = "Subject updated successfully";
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
        $delete = EpSubject::destroy($id);

        if ($delete) {
            $success = true;
            $message = "Subject Deleted successfully";
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
        $sessions = EpSubject::find($id);
        if ($sessions->active_status == 1) {
            $update=$sessions->update(['active_status' => '0']);
            return true;
        }else{
            $update=$sessions->update(['active_status' => '1']);
            return true;
        }

    }
}
