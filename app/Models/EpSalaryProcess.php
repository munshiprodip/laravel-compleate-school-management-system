<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpSalaryProcess extends Model
{
    protected $table= 'salary_process';
    protected $fillable = [
        'salary_year',
        'salary_month',
        'staff_id',
        'basic_salary',
        'house_rent',
        'conveyance_allowance',
        'medical_allowance',
        'other_allowance',
        'gross_salary',
        'd_pf',
        'd_insurance',
        'd_loan',
        'd_house_rent',
        'd_utility',
        'd_others',
        'd_total_deduction',
        'net_salary',
        'status',
        'created_by',
        'updated_by',
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\EpStaff', 'staff_id', 'id', 'ep_staffs');
    }
}
