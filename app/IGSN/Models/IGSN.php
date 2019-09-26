<?php

namespace App\IGSN\Models;

use Illuminate\Database\Eloquent\Model;

class IGSN extends Model
{
    protected $table = 'igsn';

    public function owner()
    {
        return $this->belongsTo(IGSNClient::class, 'id');
    }
}
