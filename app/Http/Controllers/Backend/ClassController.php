<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpClass;
use App\Models\EpSection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:read-class|create-class|edit-class|delete-class', ['only' => ['index', 'apiBlodgroup']]);
        $this->middleware('permission:create-class', ['only' => ['create']]);
        $this->middleware('permission:edit-class', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-class', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Exception
     */

    public function apiClass()
    {
        $data = EpClass::all();

        return Datatables::of($data)->addColumn('action',function ($data){
            return '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu text-right dropdown-menu-right">
                    <button onclick="assignSection('.$data->id.')" class="dropdown-item" type="button">Assign Section</button>
                    <button onclick="editClass('.$data->id.')" class="dropdown-item" type="button">Edit</button>
                    <button onclick="deleteClass('.$data->id.')" class="dropdown-item" type="button">Delete</button>
                </div>
            </div>';

        })->addColumn('sections', function ($data){
            //$sections =  $data->sections;
            $s = '|';
             foreach ($data->sections as $section){
              $s =  $s . $section->sections .' | ';
            }
            return $s;
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
        return view('backend.academic.classes');
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
        $data = EpClass::create($input);

        if ($data) {
            $success = true;
            $message = "Class added successfully";
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
        $data = EpClass::find($id);
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
        $data = EpClass::find($id);
        $input = $request->all();
        $update = $data->fill($input)->save();
        if ($update) {
            $success = true;
            $message = "Class updated successfully";
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
        $delete = EpClass::destroy($id);

        if ($delete) {
            $success = true;
            $message = "Class Deleted successfully";
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
        $data = EpClass::find($id);
        if ($data->active_status == 1) {
            $update=$data->update(['active_status' => '0']);
            return true;
        }else{
            $update=$data->update(['active_status' => '1']);
            return true;
        }

    }

    public function assignSectionClass($id){
        $classes = EpClass::find($id);
        $classSection = $classes->sections->pluck('sections')->all();
        $sections = EpSection::all();
        return response()->json([
            $sections,
            $classSection,
        ]);
    }
    public function classSectionList($id){
        $classes = EpClass::find($id);
        $classSection = $classes->sections;
        return response()->json([
            $classSection,
        ]);
    }
    public function assignSectionClassSubmit(Request $request, $id){
       $sections = $request['sections'];
       // $classes = EpClass::find($id);
       // $classes =  $classes->sections->sync($classes);

        $delete = DB::table('class_has_sections')->where('class_id', $id)->delete();
        foreach ($sections as $sid){
            $create = DB::table('class_has_sections')->insert([
                    ['class_id' => $id, 'section_id' => $sid]
            ]);
        };

        if ($create) {
            $success = true;
            $message = "Section assigned successfully";
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
}
