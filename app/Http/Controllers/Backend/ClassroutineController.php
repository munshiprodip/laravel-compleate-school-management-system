<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpClass;
use App\Models\EpClassroom;
use App\Models\EpClassroutine;
use App\Models\EpClasstime;
use App\Models\EpStaff;
use App\Models\EpSubject;
use Illuminate\Http\Request;

class ClassroutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $class = EpClass::all();
        return view('backend.academic.classRoutineSearch', compact('class'));
    }

    public function searchRoutine($class_id, $section_id)
    {
        $class = EpClass::all();
        $rooms = EpClassroom::all();
        $teachers = EpStaff::all();
        $subjects = EpSubject::where('class_id', $class_id)->get();
        $period = EpClasstime::all();
        $routine = EpClassroutine::where('class_id', $class_id)->where('section_id', $section_id)->get();

        return view('backend.academic.classRoutine', compact('routine', 'period', 'rooms', 'teachers', 'subjects', 'class_id', 'section_id', 'class'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $create = EpClassroutine::create($request->all());
        if ($create){
            //return redirect()->route('classroutine.index');
            return redirect('/classroutine/'.$class_id.'/'.$section_id);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $routine = EpClassroutine::find($id);
        $update = $routine->update($request->all());
        if ($update){
            return redirect('/classroutine/'.$class_id.'/'.$section_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $delete = EpClassroutine::destroy($id);
        if ($delete){
            return back();
        }
    }
}
