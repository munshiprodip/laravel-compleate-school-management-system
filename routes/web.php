<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
	    return view('backend.dashboard');
	})->name('dashboard');


    //=====Admin sections=====
        //==================Bloodgroups===================
            Route::get('/bloodgroup', 'Backend\BloodgroupController@index')->name('bloodgroup');
            Route::get('/api.bloodgroup', 'Backend\BloodgroupController@apiBlodgroup')->name('api.bloodgroup');
            Route::post('/bloodgroup/create', 'Backend\BloodgroupController@create')->name('create.bloodgroup');
            Route::get('/bloodgroup/{id}/edit', 'Backend\BloodgroupController@edit')->name('edit.bloodgroup');
            Route::patch('/bloodgroup/{id}', 'Backend\BloodgroupController@update')->name('update.bloodgroup');
            Route::delete('/bloodgroup/{id}/delete', 'Backend\BloodgroupController@destroy')->name('delete.bloodgroup');
            Route::get('/bloodgroup/status/change/{id}', 'Backend\BloodgroupController@changeStatus');



        //==================Religion===================
            Route::get('/religion', 'Backend\ReligionController@index')->name('religion');
            Route::get('/api.religion', 'Backend\ReligionController@apiReligion')->name('api.religion');
            Route::post('/religion/create', 'Backend\ReligionController@create')->name('create.religion');
            Route::get('/religion/{id}/edit', 'Backend\ReligionController@edit')->name('edit.religion');
            Route::patch('/religion/{id}', 'Backend\ReligionController@update')->name('update.religion');
            Route::delete('/religion/{id}/delete', 'Backend\ReligionController@destroy')->name('delete.religion');

        //==================Gender===================
            Route::get('/gender', 'Backend\GenderController@index')->name('gender');
            Route::get('/api.gender', 'Backend\GenderController@apiGender')->name('api.gender');
            Route::post('/gender/create', 'Backend\GenderController@create')->name('create.gender');
            Route::get('/gender/{id}/edit', 'Backend\GenderController@edit')->name('edit.gender');
            Route::patch('/gender/{id}', 'Backend\GenderController@update')->name('update.gender');
            Route::delete('/gender/{id}/delete', 'Backend\GenderController@destroy')->name('delete.gender');

        //==================Role===================
            Route::get('/role', 'Backend\RoleController@index')->name('role');
            Route::get('/api.role', 'Backend\RoleController@apiRole')->name('api.role');
            Route::post('/role/create', 'Backend\RoleController@create')->name('create.role');
            Route::get('/role/{id}/edit', 'Backend\RoleController@edit')->name('edit.role');
            Route::patch('/role/{id}', 'Backend\RoleController@update')->name('update.role');
            Route::delete('/role/{id}/delete', 'Backend\RoleController@destroy')->name('delete.role');


        //==================Permission===================
            Route::get('/permission', 'Backend\PermissionController@index')->name('permission');
            Route::get('/api.permission', 'Backend\PermissionController@apiPermission')->name('api.permission');
            Route::post('/permission/create', 'Backend\PermissionController@create')->name('create.permission');
            Route::get('/permission/{id}/edit', 'Backend\PermissionController@edit')->name('edit.permission');
            Route::patch('/permission/{id}', 'Backend\PermissionController@update')->name('update.permission');
            Route::delete('/permission/{id}/delete', 'Backend\PermissionController@destroy')->name('delete.permission');

            Route::get('/role/permission/{id}', 'Backend\PermissionController@assignRolePermission');
            Route::patch('/role/permission/assign/{id}', 'Backend\PermissionController@assignRolePermissionSubmit')->name('assignRoleUpdate');

        //==================User===================
            Route::get('/user', 'Backend\UserController@index')->name('user');
            Route::get('/api.user', 'Backend\UserController@apiUser')->name('api.user');
            Route::post('/user/create', 'Backend\UserController@create')->name('create.user');
            Route::get('/user/{id}/edit', 'Backend\UserController@edit')->name('edit.user');
            Route::patch('/user/{id}', 'Backend\UserController@update')->name('update.user');
            Route::delete('/user/{id}/delete', 'Backend\UserController@destroy')->name('delete.user');
            Route::get('/user/status/change/{id}', 'Backend\UserController@changeStatus');

            Route::get('/user/role/{id}', 'Backend\UserController@assignRoleUser')->name('assignRoleUser');
            Route::patch('/user/role/assign/{id}', 'Backend\UserController@assignRoleUserSubmit')->name('assignRoleUserSubmit');



    //=====Academic sections=====
        //==================Session===================
            Route::get('/session', 'Backend\SessionController@index')->name('session');
            Route::get('/api.session', 'Backend\SessionController@apiSession')->name('api.session');
            Route::post('/session/create', 'Backend\SessionController@create')->name('create.session');
            Route::get('/session/{id}/edit', 'Backend\SessionController@edit')->name('edit.session');
            Route::patch('/session/{id}', 'Backend\SessionController@update')->name('update.session');
            Route::delete('/session/{id}/delete', 'Backend\SessionController@destroy')->name('delete.session');
            Route::get('/session/status/change/{id}', 'Backend\SessionController@changeStatus');

        //==================Class===================
            Route::get('/class', 'Backend\ClassController@index')->name('class');
            Route::get('/api.class', 'Backend\ClassController@apiClass')->name('api.class');
            Route::post('/session/class', 'Backend\ClassController@create')->name('create.class');
            Route::get('/class/{id}/edit', 'Backend\ClassController@edit')->name('edit.class');
            Route::patch('/class/{id}', 'Backend\ClassController@update')->name('update.class');
            Route::delete('/class/{id}/delete', 'Backend\ClassController@destroy')->name('delete.class');
            Route::get('/class/status/change/{id}', 'Backend\ClassController@changeStatus');

        //==================Section===================
            Route::get('/section', 'Backend\SectionController@index')->name('section');
            Route::get('/api.section', 'Backend\SectionController@apiSection')->name('api.section');
            Route::post('/section/class', 'Backend\SectionController@create')->name('create.section');
            Route::get('/section/{id}/edit', 'Backend\SectionController@edit')->name('edit.section');
            Route::patch('/section/{id}', 'Backend\SectionController@update')->name('update.section');
            Route::delete('/section/{id}/delete', 'Backend\SectionController@destroy')->name('delete.section');
            Route::get('/section/status/change/{id}', 'Backend\SectionController@changeStatus');

            Route::get('/class/section/{id}', 'Backend\ClassController@assignSectionClass');
            Route::get('/classes/section/{id}', 'Backend\ClassController@classSectionList');
            Route::patch('/class/section/assign/{id}', 'Backend\ClassController@assignSectionClassSubmit');

        //==================Subject===================
            Route::get('/subject', 'Backend\SubjectController@index')->name('subject');
            Route::get('/api.subject', 'Backend\SubjectController@apiSubject')->name('api.subject');
            Route::post('/subject/create', 'Backend\SubjectController@create')->name('create.subject');
            Route::get('/subject/{id}/edit', 'Backend\SubjectController@edit')->name('edit.subject');
            Route::patch('/subject/{id}', 'Backend\SubjectController@update')->name('update.subject');
            Route::delete('/subject/{id}/delete', 'Backend\SubjectController@destroy')->name('delete.subject');
            Route::get('/subject/status/change/{id}', 'Backend\SubjectController@changeStatus');

        //==================Classroom===================
            Route::get('/classroom', 'Backend\ClassroomController@index')->name('classroom');
            Route::get('/api.classroom', 'Backend\ClassroomController@apiClassroom')->name('api.classroom');
            Route::post('/classroom/create', 'Backend\ClassroomController@create')->name('create.classroom');
            Route::get('/classroom/{id}/edit', 'Backend\ClassroomController@edit')->name('edit.classroom');
            Route::patch('/classroom/{id}', 'Backend\ClassroomController@update')->name('update.classroom');
            Route::delete('/classroom/{id}/delete', 'Backend\ClassroomController@destroy')->name('delete.classroom');
            Route::get('/classroom/status/change/{id}', 'Backend\ClassroomController@changeStatus');

        //==================Classtime===================
            Route::get('/classtime', 'Backend\ClasstimeController@index')->name('classtime');
            Route::get('/api.classtime', 'Backend\ClasstimeController@apiClasstime')->name('api.classtime');
            Route::post('/classtime/create', 'Backend\ClasstimeController@create')->name('create.classtime');
            Route::get('/classtime/{id}/edit', 'Backend\ClasstimeController@edit')->name('edit.classtime');
            Route::patch('/classtime/{id}', 'Backend\ClasstimeController@update')->name('update.classtime');
            Route::delete('/classtime/{id}/delete', 'Backend\ClasstimeController@destroy')->name('delete.classtime');
            Route::get('/classtime/status/change/{id}', 'Backend\ClasstimeController@changeStatus');

        //==================Classtime===================
            Route::resource('classroutine', 'Backend\ClassroutineController');
            Route::get('/classroutine/{class_id}/{section_id}', 'Backend\ClassroutineController@searchRoutine');



    //=====Student sections=====
        //==================Category===================
            Route::get('/studentCategory', 'Backend\StudentCategoryController@index')->name('studentCategory');
            Route::get('/api.studentCategory', 'Backend\StudentCategoryController@apiStudentCategory')->name('api.studentCategory');
            Route::post('/studentCategory/create', 'Backend\StudentCategoryController@create')->name('create.studentCategory');
            Route::get('/studentCategory/{id}/edit', 'Backend\StudentCategoryController@edit')->name('edit.studentCategory');
            Route::patch('/studentCategory/{id}', 'Backend\StudentCategoryController@update')->name('update.studentCategory');
            Route::delete('/studentCategory/{id}/delete', 'Backend\StudentCategoryController@destroy')->name('delete.studentCategory');
            Route::get('/studentCategory/status/change/{id}', 'Backend\StudentCategoryController@changeStatus');


        //==================students===================
            Route::resource('students', 'Backend\StudentController');

            Route::get('/promote/students', 'Backend\StudentController@promoteStudents')->name('promoteStudents');
            Route::post('/promote/students/submit', 'Backend\StudentController@promoteStudentsSubmit')->name('promoteStudentsSubmit');
            Route::get('/students/list/deactivated', 'Backend\StudentController@deactivatedList')->name('disabledStudents');
            Route::get('/students/status/change/{id}', 'Backend\StudentController@changeStatus');
            Route::get('/student/api/{class}/{section}', 'Backend\StudentController@studentApi');


        //==================parents===================
            Route::resource('parents', 'Backend\ParentController');

    //=====HR sections=====
        //=====Department=====
            Route::get('/department', 'Backend\DepartmentController@index')->name('department');
            Route::get('/api.department', 'Backend\DepartmentController@apiDepartment')->name('api.department');
            Route::post('/department/create', 'Backend\DepartmentController@create')->name('create.department');
            Route::get('/department/{id}/edit', 'Backend\DepartmentController@edit')->name('edit.department');
            Route::patch('/department/{id}', 'Backend\DepartmentController@update')->name('update.department');
            Route::delete('/department/{id}/delete', 'Backend\DepartmentController@destroy')->name('delete.department');
            Route::get('/department/status/change/{id}', 'Backend\DepartmentController@changeStatus');


        //=====Designation=====
            Route::get('/designation', 'Backend\DesignationController@index')->name('designation');
            Route::get('/api.designation', 'Backend\DesignationController@apiDesignation')->name('api.designation');
            Route::post('/designation/create', 'Backend\DesignationController@create')->name('create.designation');
            Route::get('/designation/{id}/edit', 'Backend\DesignationController@edit')->name('edit.designation');
            Route::patch('/designation/{id}', 'Backend\DesignationController@update')->name('update.designation');
            Route::delete('/designation/{id}/delete', 'Backend\DesignationController@destroy')->name('delete.designation');
            Route::get('/designation/status/change/{id}', 'Backend\DesignationController@changeStatus');

        //=====Staff=====
            Route::resource('staffs', 'Backend\StaffController');
            Route::get('/staffs/status/change/{id}', 'Backend\StaffController@changeStatus');




            Route::get('delete/photo/{id}', 'Backend\StudentController@testDelete');


    //=========== Accounts =============
        //=========== Salary =============
            Route::get('salary/deduction', 'Backend\SalaryController@salaryDeduction')->name('salary.deduction');
            Route::post('salary/deduction/store', 'Backend\SalaryController@salaryDeductionStore')->name('salary.deduction.store');
            Route::patch('salary/deduction/update/{id}', 'Backend\SalaryController@salaryDeductionUpdate')->name('salary.deduction.update');
            Route::get('/salary/process', 'Backend\SalaryController@salaryProcess')->name('salary.process');
            Route::post('/salary/process/submit', 'Backend\SalaryController@salaryProcessSubmit')->name('salary.process.submit');
            Route::get('/salary/sheet', 'Backend\SalaryController@salarySheet')->name('salary.sheet');
            Route::get('salary/pay/{id}', 'Backend\SalaryController@salaryPay');
            Route::get('salary/details/{id}', 'Backend\SalaryController@salaryDetails')->name('salary.details');

        //=========== Fees =============
            Route::resource('feestypes', 'Backend\FeesTypeController');
            Route::get('/api.feestypes', 'Backend\FeesTypeController@apiFeesType')->name('api.feesType');
            Route::get('/feestypes/status/change/{id}', 'Backend\FeesTypeController@changeStatus');

            Route::resource('feessetup', 'Backend\FeesSetupController');
            Route::get('/api.feessetup', 'Backend\FeesSetupController@apiFeesSetup')->name('api.feesSetup');
            Route::get('/feessetup/status/change/{id}', 'Backend\FeesSetupController@changeStatus');
            Route::get('/assignfees/{id}', 'Backend\FeesSetupController@assignFees')->name('assignFees');
            Route::post('/assignfees/submit/{id}', 'Backend\FeesSetupController@assignFeesSubmit')->name('assignFeesSubmit');
            Route::get('/student/api/{class}/{section}/{fees}', 'Backend\FeesSetupController@studentApi');
            Route::get('/fees/collect/', 'Backend\FeesSetupController@collectFees')->name('fees.collect');
});



