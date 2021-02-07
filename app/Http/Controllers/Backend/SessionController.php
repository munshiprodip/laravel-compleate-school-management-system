<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpSession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SessionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:read-session|create-session|edit-session|delete-session', ['only' => ['index', 'apiBlodgroup']]);
        $this->middleware('permission:create-session', ['only' => ['create']]);
        $this->middleware('permission:edit-session', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-session', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Exception
     */

    public function apiSession()
    {
        $data = DB::table('ep_sessions')->get();

        return Datatables::of($data)->addColumn('action',function ($data){
            return '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu text-right dropdown-menu-right">
                    <button onclick="editSession('.$data->id.')" class="dropdown-item" type="button">Edit</button>
                    <button onclick="deleteSession('.$data->id.')" class="dropdown-item" type="button">Delete</button>
                </div>
            </div>';

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
        return view('backend.academic.sessions');
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
        $data = EpSession::create($input);

        if ($data) {
            $success = true;
            $message = "Session added successfully";
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
        $data = EpSession::find($id);
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
        $data = EpSession::find($id);
        $input = $request->all();
        $update = $data->fill($input)->save();
        if ($update) {
            $success = true;
            $message = "Session updated successfully";
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
        $delete = EpSession::destroy($id);

        if ($delete) {
            $success = true;
            $message = "Session Deleted successfully";
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
        $sessions = EpSession::find($id);
        if ($sessions->active_status == 1) {
            $update=$sessions->update(['active_status' => '0']);
            return true;
        }else{
            $update=$sessions->update(['active_status' => '1']);
            return true;
        }

    }
}
