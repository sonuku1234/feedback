<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveys extends Model
{
    use HasFactory;
    protected $fillable = [
        'coordinator_id',
        'name',
        'questions',
        'start_time',
        'end_time',
    ];
}
