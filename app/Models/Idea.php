<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Idea extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $table = 'ideas';

    protected $fillable = [
        'user_id',
        'user_name',
        'title',
        'destination',
        'start_date',
        'end_date',
        'tags',

    ];
}
