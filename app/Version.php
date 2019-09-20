<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable = ['schema_id', 'record_id', 'data', 'status'];

    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }

    public function schema()
    {
        return $this->hasOne(Schema::class, 'schema_id', 'schema_id');
    }
}
