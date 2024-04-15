<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Idea extends Model
{
    use HasFactory;

    use SoftDeletes;

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
        'latitude',
        'longitude',
        'start_date',
        'end_date',
        'tags',
        'favorites',

    ];
    public function toggleLike() {
        $user = auth()->user();

        if (!$user) {
            // 处理用户未认证的情况
            return;
        }

        if ($this->isLikedByUser($user)) {
            $this->decrement('favorites');
            $this->users()->detach($user->id);
        } else {
            $this->increment('favorites');
            $this->users()->attach($user->id);
        }
    }

    public function isLikedByUser($user) {
        return $this->users->contains($user);
    }


}
