<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpSalaryDeduction extends Model
{
    protected $table= 'salary_deductions';
    protected $fillable = [
        'deduction_year',
        'deduction_month',
        'pf',
        'insurance',
        'loan',
        'house_rent',
        'utility',
        'others',
        'total',
        'staff_id',
        'created_by',
        'updated_by',
    ];
}
