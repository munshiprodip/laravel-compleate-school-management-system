<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EpBloodgroup;
use App\Models\EpClass;
use App\Models\EpFeesSetup;
use App\Models\EpGender;
use App\Models\EpParent;
use App\Models\EpReligion;
use App\Models\EpSection;
use App\Models\EpSession;
use App\Models\EpStudent;
use App\Models\EpStudentCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-student|create-student|edit-student|delete-student', ['only' => ['index', 'apiPermission']]);
        $this->middleware('permission:create-student', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-student', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-student', ['only' => ['destroy']]);

    }

    public function testDelete($id){

        $studentPhotoPath = 'images/students/';
        Storage::delete($studentPhotoPath.$id);
    }

    public function generateId(){
        $all_student = EpStudent::all();
        if ($all_student->count() > 0){
            $last_id = EpStudent::latest()->first()->id;
            $id = 'S'.date('Y').'00'.++$last_id;
        }else{
            $id = 'S'.date('Y').'000';
        }
        return $id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $i = 0;
        $student = EpStudent::where('active_status', 1)->get();
        return view('backend.student.list', compact('student', 'i'));
    }
    public function deactivatedList()
    {
        $i = 0;
        $student = EpStudent::where('active_status', 0)->get();
        return view('backend.student.deactivated', compact('student', 'i'));
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
        $session = EpSession::all();
        $class = EpClass::all();
        $section = EpSection::all();
        $category = EpStudentCategory::all();
        $parents = EpParent::all();

        return view('backend.student.create', compact('blood','religion','gender','session','class','section', 'category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request['parents_id'] == ''){
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'gender_id' => 'required',
                'bloodgroup_id' => 'required',
                'religion_id' => 'required',
                'date_of_birth' => 'required',
                'current_address' => 'required',
                'permanent_address' => 'required',
                'session_id' => 'required',
                'roll_no' => 'required',
                'admission_date' => 'required',
                'student_category_id' => 'required',
                'class_id' => 'required',
                'section_id' => 'required',
                'created_by' => 'required',
                'student_photo' => 'required|mimes:jpg,jpeg,png,gif|max:1024',
                'student_email' => 'required|email',




                'fathers_name' => 'required',
                'mothers_name' => 'required',
                'parents_email' => 'required|email',
                'fathers_mobile' => 'required|unique:ep_parents|min:11',
                'fathers_photo' => 'required|mimes:jpg,jpeg,png,gif|max:1024',
                'mothers_photo' => 'required|mimes:jpg,jpeg,png,gif|max:1024'

            ]);

            if ($validator->fails()) {

                alert()->toast($validator->messages()->all()[0], 'error');
                return back()->withInput();

            }else{

                $input['first_name']                    = $request['first_name'];
                $input['last_name']                     = $request['last_name'];
                $input['full_name']                     = $request['first_name'].' '.$request['last_name'];
                $input['gender_id']                     = $request['gender_id'];
                $input['bloodgroup_id']                 = $request['bloodgroup_id'];
                $input['religion_id']                   = $request['religion_id'];
                $input['date_of_birth']                 = $request['date_of_birth'];
                $input['mobile']                        = $request['mobile'];
                $input['student_photo']                 = $request['student_photo'];
                $input['national_id']                   = $request['national_id'];
                $input['bank_account_no']               = $request['bank_account_no'];
                $input['bank_name']                     = $request['bank_name'];
                $input['current_address']               = $request['current_address'];
                $input['permanent_address']             = $request['permanent_address'];
                $input['previous_school_information']   = $request['previous_school_information'];
                $input['additional_notes']              = $request['additional_notes'];
                $input['session_id']                    = $request['session_id'];
                $input['admission_no']                  = $this->generateId();
                $input['roll_no']                       = $request['roll_no'];
                $input['admission_date']                = $request['admission_date'];
                $input['student_category_id']           = $request['student_category_id'];
                $input['class_id']                      = $request['class_id'];
                $input['section_id']                    = $request['section_id'];
                $input['created_by']                    = $request['created_by'];

                $student_user_data['name']              = $request['first_name'];
                $student_user_data['email']             = $request['student_email'];
                $student_user_data['user_type']         = 'Student';
                $student_user_data['password']          = Hash::make('12345678');



                $parents_data['fathers_name']           = $request['fathers_name'];
                $parents_data['fathers_occupation']     = $request['fathers_occupation'];
                $parents_data['mothers_name']           = $request['mothers_name'];
                $parents_data['mothers_occupation']     = $request['mothers_occupation'];
                $parents_data['fathers_mobile']         = $request['fathers_mobile'];
                $parents_data['mothers_mobile']         = $request['mothers_mobile'];
                $parents_data['created_by']             = $request['created_by'];

                $parents_user_data['name']              = $request['fathers_name'];
                $parents_user_data['email']             = $request['parents_email'];
                $parents_user_data['user_type']         = 'Parent';
                $parents_user_data['password']          = Hash::make('12345678');

                if ($request->hasFile('student_photo')  && $request->hasFile('fathers_photo') && $request->hasFile('mothers_photo')){
                    $input['student_photo']                 =time().'_'.$request->student_photo->getClientOriginalName();
                    $parents_data['fathers_photo']          =time().'_f_'.$request->fathers_photo->getClientOriginalName();
                    $parents_data['mothers_photo']          =time().'_m_'.$request->mothers_photo->getClientOriginalName();

                    $request->file('student_photo')->storeAs('images/students', $input['student_photo']);
                    $request->file('fathers_photo')->storeAs('images/parents', $parents_data['fathers_photo']);
                    $request->file('mothers_photo')->storeAs('images/parents', $parents_data['mothers_photo']);

                }else{
                    alert()->toast('Select all photos', 'error');
                    return back()->withInput();
                }

                $student_user = User::create($student_user_data);
                $parents_user = User::create($parents_user_data);

                if ($student_user && $parents_user){
                    $input['user_id']           = $student_user['id'];
                    $parents_data['user_id']    = $parents_user['id'];

                    $student_user->assignRole('Student');
                    $parents_user->assignRole('Parent');

                    $parents_create = EpParent::create($parents_data);
                    if ($parents_create){
                        $input['parents_id'] = $parents_create['id'];
                        $student_create = EpStudent::create($input);
                    }

                }
            }
        }else{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'gender_id' => 'required',
                'bloodgroup_id' => 'required',
                'religion_id' => 'required',
                'date_of_birth' => 'required',
                'current_address' => 'required',
                'permanent_address' => 'required',
                'session_id' => 'required',
                'roll_no' => 'required',
                'admission_date' => 'required',
                'student_category_id' => 'required',
                'class_id' => 'required',
                'section_id' => 'required',
                'created_by' => 'required',
                'student_photo' => 'required|mimes:jpg,jpeg,png,gif|max:1024',
                'student_email' => 'required|email'
            ]);

            if ($validator->fails()) {

                alert()->toast($validator->messages()->all()[0], 'error');
                return back()->withInput();

            }else{
                $input['first_name']                    = $request['first_name'];
                $input['last_name']                     = $request['last_name'];
                $input['full_name']                     = $request['first_name'].' '.$request['last_name'];
                $input['gender_id']                     = $request['gender_id'];
                $input['bloodgroup_id']                 = $request['bloodgroup_id'];
                $input['religion_id']                   = $request['religion_id'];
                $input['date_of_birth']                 = $request['date_of_birth'];
                $input['mobile']                        = $request['mobile'];
                $input['student_photo']                 = $request['student_photo'];
                $input['national_id']                   = $request['national_id'];
                $input['bank_account_no']               = $request['bank_account_no'];
                $input['bank_name']                     = $request['bank_name'];
                $input['current_address']               = $request['current_address'];
                $input['permanent_address']             = $request['permanent_address'];
                $input['previous_school_information']   = $request['previous_school_information'];
                $input['additional_notes']              = $request['additional_notes'];
                $input['session_id']                    = $request['session_id'];
                $input['admission_no']                  = $this->generateId();
                $input['roll_no']                       = $request['roll_no'];
                $input['admission_date']                = $request['admission_date'];
                $input['student_category_id']           = $request['student_category_id'];
                $input['class_id']                      = $request['class_id'];
                $input['section_id']                    = $request['section_id'];
                $input['created_by']                    = $request['created_by'];
                $input['parents_id']                    = $request['parents_id'];

                $student_user_data['name']              = $request['first_name'];
                $student_user_data['email']             = $request['student_email'];
                $student_user_data['user_type']         = 'Student';
                $student_user_data['password']          = Hash::make('12345678');



                if ($request->hasFile('student_photo')){
                    $input['student_photo']                 =time().'_'.$request->student_photo->getClientOriginalName();
                    $request->file('student_photo')->storeAs('images/students', $input['student_photo']);

                }else{
                    alert()->toast('Select student photo', 'error');
                    return back()->withInput();
                }

                $student_user = User::create($student_user_data);

                if ($student_user){
                    $input['user_id']           = $student_user['id'];

                    $student_user->assignRole('Student');

                    $student_create = EpStudent::create($input);
                }
            }
        }


        alert()->toast('Student admitted successfully', 'success');
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = EpStudent::find($id);
        return view('backend.student.details', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $student = EpStudent::find($id);

        $blood = EpBloodgroup::all();
        $religion = EpReligion::all();
        $gender = EpGender::all();
        $session = EpSession::all();
        $class = EpClass::all();
        $section = EpSection::all();
        $category = EpStudentCategory::all();
        $parents = EpParent::all();

        return view('backend.student.edit', compact('student', 'blood', 'religion', 'gender', 'session', 'class', 'section', 'category', 'parents'));
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
        $student = EpStudent::find($id);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'gender_id' => 'required',
            'bloodgroup_id' => 'required',
            'religion_id' => 'required',
            'date_of_birth' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'session_id' => 'required',
            'roll_no' => 'required',
            'student_category_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'updated_by' => 'required'

        ]);

        if ($validator->fails()) {

            alert()->toast($validator->messages()->all()[0], 'error');
            return back()->withInput();

        }else {
            $input['first_name'] = $request['first_name'];
            $input['last_name'] = $request['last_name'];
            $input['full_name'] = $request['first_name'] . ' ' . $request['last_name'];
            $input['gender_id'] = $request['gender_id'];
            $input['bloodgroup_id'] = $request['bloodgroup_id'];
            $input['religion_id'] = $request['religion_id'];
            $input['date_of_birth'] = $request['date_of_birth'];
            $input['mobile'] = $request['mobile'];
            $input['national_id'] = $request['national_id'];
            $input['bank_account_no'] = $request['bank_account_no'];
            $input['bank_name'] = $request['bank_name'];
            $input['current_address'] = $request['current_address'];
            $input['permanent_address'] = $request['permanent_address'];
            $input['previous_school_information'] = $request['previous_school_information'];
            $input['additional_notes'] = $request['additional_notes'];
            $input['session_id'] = $request['session_id'];
            $input['roll_no'] = $request['roll_no'];
            $input['student_category_id'] = $request['student_category_id'];
            $input['class_id'] = $request['class_id'];
            $input['section_id'] = $request['section_id'];
            $input['updated_by'] = $request['creatupdated_byed_by'];


            $update = $student->update($input);
            if ($update){
                alert()->toast('Student data updated successfully', 'success');
                return redirect()->route('students.index');
            }else{
                alert()->toast('Ops!! Something else...', 'error');
                return back()->withInput();
            }
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
       $student = EpStudent::find($id);
       $parents = $student->parents;
       $s_user = $student->user;
       $p_user = $parents->user;

       $s_photo = $student->student_photo;
       $f_photo = $parents->fathers_photo;
       $m_photo = $parents->mothers_photo;

       $parentsPhotoPath = 'images/parents/';
       $studentPhotoPath = 'images/students/';
        Storage::delete($studentPhotoPath.$s_photo);

       $s_user->delete();
       $student->delete();

       $children = $parents->students;
       if ($children->count() < 1){
           Storage::delete($parentsPhotoPath.$f_photo);
           Storage::delete($parentsPhotoPath.$m_photo);
           $p_user->delete();
           $parents->delete();
       }
        alert()->toast('Student deleted successfully', 'success');
        return redirect()->route('students.index');

    }

    public function changeStatus($id){
        $student = EpStudent::find($id);
        if ($student->active_status == 1) {
            $student->update(['active_status' => '0']);
            $student->user->update(['active_status' => '0']);

            alert()->toast('Student deactivated successfully', 'success');
            return redirect()->route('students.index');
        }else{
            $student->update(['active_status' => '1']);
            $student->user->update(['active_status' => '1']);

            alert()->toast('Student activate successfully', 'success');
            return redirect()->route('students.index');
        }

    }
    public function promoteStudents(){
        $class = EpClass::all();
        return view('backend.student.promote', compact('class'));
    }

    public function studentApi($class_id, $section_id){
        $data = EpStudent::where('class_id', $class_id)->where('section_id', $section_id)->where('active_status', 1)->get();

        return Datatables::of($data)->toJson();
    }

    public function promoteStudentsSubmit(Request $request){


        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please select all options',
            ]);
        }
        $ids = $request['student_id'];
        $update['class_id'] = $request['class_id'];
        $update['section_id'] = $request['section_id'];


        $data = EpStudent::whereIn('id', $ids)->update($update);
        if ($data) {
            $success = true;
            $message = "Student Promoted successfully";
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
