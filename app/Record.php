<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['title', 'data_source_id'];

    public function datasource()
    {
        return $this->belongsTo(DataSource::class, 'data_source_id');
    }
}
