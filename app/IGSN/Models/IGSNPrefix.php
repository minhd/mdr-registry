<?php

namespace App\IGSN\Models;

use Illuminate\Database\Eloquent\Model;

class IGSNPrefix extends Model
{
    protected $table = 'igsn_prefixes';

    public function clients()
    {
        return $this->belongsToMany(IGSNClient::class, 'igsn_client_prefix', 'prefix_id', 'client_id');
    }
}
