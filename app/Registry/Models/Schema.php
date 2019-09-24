<?php

namespace App\Registry\Models;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $fillable = ['schema_id', 'title', 'description', 'format', 'user_id'];
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
