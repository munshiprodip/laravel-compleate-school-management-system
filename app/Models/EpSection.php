<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EpSection extends Model
{
    protected $table= 'ep_sections';
    protected $fillable = [
        'sections', 'active_status', 'created_by', 'updated_by',
    ];

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\Models\EpClass',
            'class_has_sections',
            'class_id',
            'section_id'
        );
    }
}
