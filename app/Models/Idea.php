<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $table = 'ideas';

    protected $fillable = [
        'user_id',
        'title',
        'destination',
        'start_date',
        'end_date',
        'tags',

    ];
}
