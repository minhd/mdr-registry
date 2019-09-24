<?php

namespace App\Registry\Models;

use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    protected $fillable = ['title', 'user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
