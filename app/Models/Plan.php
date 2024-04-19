<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_name',
        'title',
    ];
    public function ideas()
    {
        return $this->belongsToMany(Idea::class, 'plan_ideas', 'plan_id', 'idea_id');
    }

}
