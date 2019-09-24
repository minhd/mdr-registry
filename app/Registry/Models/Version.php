<?php

namespace App\Registry\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable = ['schema', 'record_id', 'data', 'status'];

    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }
}
