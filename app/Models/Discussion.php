<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\DiscussionImage;
use App\Models\DiscussionUpVote;
use App\Models\DiscussionDownVote;
use App\Models\DiscussionComment;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'topics'
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(DiscussionImage::class);
    }

    public function up_votes()
    {
        return $this->hasMany(DiscussionUpVote::class);
    }

    public function down_votes()
    {
        return $this->hasMany(DiscussionDownVote::class);
    }

    public function comments()
    {
        return $this->hasMany(DiscussionComment::class);
    }
}
