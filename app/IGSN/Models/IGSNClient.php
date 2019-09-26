<?php

namespace App\IGSN\Models;

use App\Registry\Models\DataSource;
use App\Registry\Models\User;
use Illuminate\Database\Eloquent\Model;

class IGSNClient extends Model
{
    protected $table = 'igsn_clients';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function prefixes()
    {
        return $this->belongsToMany(IGSNPrefix::class, 'igsn_client_prefix', 'client_id', 'prefix_id');
    }

    public function datasource()
    {
        return $this->belongsTo(DataSource::class, 'data_source_id');
    }
}
