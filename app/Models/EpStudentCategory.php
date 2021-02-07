<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpStudentCategory extends Model
{
    protected $table= 'ep_student_categorys';
    protected $fillable = [
        'student_categorys', 'active_status', 'created_by', 'updated_by',
    ];
}
