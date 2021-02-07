<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpBloodgroup;
use App\Models\EpDepartment;
use App\Models\EpDesignation;
use App\Models\EpGender;
use App\Models\EpReligion;
use App\Models\EpStaff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    public function generateId(){
        $all_staffs = EpStaff::all();
        if ($all_staffs->count() > 0){
            $last_id = EpStaff::latest()->first()->id;
            $staff_id = 'E'.date('Y').'00'.++$last_id;
        }else{
            $staff_id = 'E'.date('Y').'000';
        }
        return $staff_id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $staffs = EpStaff::all();
        $i = 0;
        return view('backend.hr.staff.list', compact('staffs', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $blood = EpBloodgroup::all();
        $religion = EpReligion::all();
        $gender = EpGender::all();
        $department = EpDepartment::all();
        $designation = EpDesignation::all();

        return view('backend.hr.staff.create', compact('blood', 'religion', 'gender', 'department', 'designation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

                'email' => 'required|unique:users|email',
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'gender_id' => 'required',
                'bloodgroup_id' => 'required',
                'religion_id' => 'required',
                'date_of_birth' => 'required',
                'current_address' => 'required',
                'permanent_address' => 'required',
                'created_by' => 'required',
                'staff_photo' => 'required|mimes:jpg,jpeg,png,gif|max:1024',
                'fathers_name' => 'required',
                'mothers_name' => 'required'

            ]);

            if ($validator->fails()) {

                alert()->toast($validator->messages()->all()[0], 'error');
                return back()->withInput();

            }else{



                $input                                  = $request->all();
                $input['staff_id']                      = $this->generateId();
                $input['full_name']                     = $request['first_name'].' '.$request['last_name'];


                $user_input['name']              = $input['full_name'];
                $user_input['email']             = $request['email'];
                $user_input['user_type']         = 'Employee';
                $user_input['password']          = Hash::make('12345678');


                if ($request->hasFile('staff_photo')){
                    $input['staff_photo']                 =time().'_'.$request->staff_photo->getClientOriginalName();
                        $request->file('staff_photo')->storeAs('images/staffs', $input['staff_photo']);

                    if ($request->hasFile('joining_letter')){
                        $input['joining_letter']                 =time().'_'.$request->joining_letter->getClientOriginalName();
                        $request->file('joining_letter')->storeAs('files/staffs', $input['joining_letter']);
                    }

                    if ($request->hasFile('resume')){
                        $input['resume']                 =time().'_'.$request->resume->getClientOriginalName();
                        $request->file('resume')->storeAs('images/staffs', $input['resume']);
                    }

                }else{
                    alert()->toast('Select photo', 'error');
                    return back()->withInput();
                }

                $user_input = User::create($user_input);

                if ($user_input){
                    $input['user_id']           = $user_input['id'];
                    $user_input->assignRole('General');
                    EpStaff::create($input);
                }
            }


        alert()->toast('Employee added successfully', 'success');
        return redirect()->route('staffs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $staff = EpStaff::find($id);

        return view('backend.hr.staff.details', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $department = EpDepartment::all();
        $designation = EpDesignation::all();

        $blood      = EpBloodgroup::all();
        $religion   = EpReligion::all();
        $gender     = EpGender::all();
        $staff      = EpStaff::find($id);
        return view('backend.hr.staff.edit', compact('staff', 'blood', 'religion', 'gender', 'department', 'designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $staff = EpStaff::find($id);
        $validator = Validator::make($request->all(), [

            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'gender_id' => 'required',
            'bloodgroup_id' => 'required',
            'religion_id' => 'required',
            'date_of_birth' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'updated_by' => 'required',
            'fathers_name' => 'required',
            'mothers_name' => 'required'

        ]);

        if ($validator->fails()) {

            alert()->toast($validator->messages()->all()[0], 'error');
            return back();

        }else{
            $input                                  = $request->all();
            $input['full_name']                     = $request['first_name'].' '.$request['last_name'];
            $staff->update($input);
        }


        alert()->toast('Employee Information updated successfully', 'success');
        return redirect()->route('staffs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $staff = EpStaff::find($id);
        $s_user = $staff->user;
        $s_photo = $staff->staff_photo;

        $staffPhotoPath = 'images/staffs/';
        Storage::delete($staffPhotoPath.$s_photo);

        $s_user->delete();
        $staff->delete();

        alert()->toast('Staff deleted successfully', 'success');
        return redirect()->route('staffs.index');
    }

    public function changeStatus($id){
        $staff = EpStaff::find($id);
        if ($staff->active_status == 1) {
            $update =$staff->update(['active_status' => '0']);
            $staff->user->update(['active_status' => '0']);
            $success = true;
            $message = "Employee deactivated successfully";
        }else{
            $update=$staff->update(['active_status' => '1']);
            $staff->user->update(['active_status' => '1']);
            $success = true;
            $message = "Employee activate successfully";
        }


        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

    }
}
