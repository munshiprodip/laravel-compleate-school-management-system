<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpStudent extends Model
{
    protected $table = 'ep_students';
    protected $fillable = [
        'admission_no', 'roll_no', 'first_name', 'last_name', 'full_name', 'date_of_birth',
        'mobile', 'admission_date', 'student_photo', 'current_address', 'permanent_address',
        'national_id', 'bank_account_no', 'bank_name', 'previous_school_information', 'additional_notes',
        'bloodgroup_id', 'religion_id', 'student_category_id', 'class_id', 'section_id', 'session_id',
        'gender_id', 'parents_id', 'active_status', 'created_by', 'updated_by', 'user_id',
    ];

    public function classes()
    {
        return $this->belongsTo('App\Models\EpClass', 'class_id', 'id', 'ep_subjects');
    }
    public function bloodgroups()
    {
        return $this->belongsTo('App\Models\EpBloodgroup', 'bloodgroup_id', 'id', 'ep_bloodgroup');
    }
    public function religion()
    {
        return $this->belongsTo('App\Models\EpReligion', 'religion_id', 'id', 'ep_religion');
    }
    public function student_category()
    {
        return $this->belongsTo('App\Models\EpStudentCategory', 'student_category_id', 'id', 'ep_student_categorys');
    }
    public function sections()
    {
        return $this->belongsTo('App\Models\EpSection', 'section_id', 'id', 'ep_sections');
    }
    public function sessions()
    {
        return $this->belongsTo('App\Models\EpSession', 'session_id', 'id', 'ep_sessions');
    }
    public function genders()
    {
        return $this->belongsTo('App\Models\EpGender', 'gender_id', 'id', 'ep_genders');
    }
    public function parents()
    {
        return $this->belongsTo('App\Models\EpParent', 'parents_id', 'id', 'ep_parents');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'ep_students');
    }

    public function assignedFees()
    {
        return $this->belongsToMany(EpFeesSetup::class, 'ep_assign_fees', 'student_id', 'fees_id');
    }


}
