<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\CollectedBy;
use App\Collections\PostCollection;

#[CollectedBy(PostCollection::class)]
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
