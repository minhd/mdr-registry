<?php

namespace App\Registry\Models;

use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    public function records()
    {
        return $this->belongsToMany(Record::class, 'records_identifiers');
    }
}
