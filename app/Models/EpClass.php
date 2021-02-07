<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EpClass extends Model
{
    protected $table= 'ep_classes';
    protected $fillable = [
        'classes', 'active_status', 'created_by', 'updated_by',
    ];

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\Models\EpSection',
            'class_has_sections',
            'class_id',
            'section_id'
        );
    }
}
