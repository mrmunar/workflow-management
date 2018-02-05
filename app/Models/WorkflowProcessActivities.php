<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkflowProcessActivities extends Model
{
    protected $fillable = [
        'process_id', 'activity_id', 'processor'
    ];
}