<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpStaff extends Model
{
    protected $table = 'ep_staffs';
    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'full_name',
        'fathers_name',
        'mothers_name',
        'date_of_birth',
        'date_of_joining',
        'nid',
        'email',
        'mobile',
        'emergency_mobile',
        'marital_status',
        'staff_photo',
        'current_address',
        'permanent_address',
        'qualification',
        'experience',
        'contract_type',
        'casual_leave',
        'medical_leave',
        'metarnity_leave',
        'bank_account_name',
        'bank_account_no',
        'bank_name',
        'bank_branch',
        'facebook_url',
        'twiteer_url',
        'linkedin_url',
        'instagram_url',
        'joining_letter',
        'resume',
        'other_document',
        'notes',
        'driving_license',
        'driving_license_ex_date',
        'designation_id',
        'department_id',
        'gender_id',
        'bloodgroup_id',
        'religion_id',
        'user_id',
        'active_status',
        'created_by',
        'updated_by',
        'basic_salary',
        'house_rent',
        'conveyance_allowance',
        'medical_allowance',
        'other_allowance',
        'gross_salary',
    ];

    public function designations()
    {
        return $this->belongsTo('App\Models\EpDesignation', 'designation_id', 'id', 'ep_designations');
    }
    public function departments()
    {
        return $this->belongsTo('App\Models\EpDepartment', 'department_id', 'id', 'ep_departments');
    }
    public function bloodgroups()
    {
        return $this->belongsTo('App\Models\EpBloodgroup', 'bloodgroup_id', 'id', 'ep_bloodgroup');
    }
    public function religion()
    {
        return $this->belongsTo('App\Models\EpReligion', 'religion_id', 'id', 'ep_religion');
    }
    public function genders()
    {
        return $this->belongsTo('App\Models\EpGender', 'gender_id', 'id', 'ep_genders');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'ep_staffs');
    }
}
