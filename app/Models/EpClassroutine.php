<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpClassroutine extends Model
{
    protected $table = 'ep_classroutines';
    protected $fillable = [
        'day', 'created_by', 'updated_by', 'active_status', 'class_id', 'section_id',
        'period_id', 'subject_id', 'teacher_id', 'room_id',
    ];

    public function classes()
    {
        return $this->belongsTo('App\Models\EpClasses', 'class_id', 'id', 'ep_classes');
    }

    public function sections()
    {
        return $this->belongsTo('App\Models\EpSection', 'section_id', 'id', 'ep_sections');
    }

    public function period()
    {
        return $this->belongsTo('App\Models\EpClasstime', 'period_id', 'id', 'ep_classtimes');
    }

    public function subjects()
    {
        return $this->belongsTo('App\Models\EpSubject', 'subject_id', 'id', 'ep_subjecs');
    }

    public function teachers()
    {
        return $this->belongsTo('App\Models\EpStaff', 'teacher_id', 'id', 'ep_staffs');
    }

    public function classrooms()
    {
        return $this->belongsTo('App\Models\EpClassroom', 'room_id', 'id', 'ep_classrooms');
    }
}
