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

    public function setActivePrefix(IGSNPrefix $prefix)
    {
        $not = $this->prefixes()->where('prefix', '!=', $prefix->prefix);
        $not->each(function($relation){
            $relation->pivot->active = false;
            $relation->pivot->save();
        });

        $match = $this->prefixes()->where('prefix', $prefix->prefix)->first();
        $match->pivot->active = true;
        $match->pivot->save();
    }

    public function getActivePrefixAttribute()
    {
        return $this->prefixes()->where('active', true)->first();
    }

    public function datasource()
    {
        return $this->belongsTo(DataSource::class, 'data_source_id');
    }
}
