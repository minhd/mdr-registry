<?php

namespace App\Registry\Models;

use App\Registry\Models\Identifier;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['title', 'data_source_id'];

    protected $casts = [
        'meta' => 'json'
    ];

    public function datasource()
    {
        return $this->belongsTo(DataSource::class, 'data_source_id');
    }

    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    public function identifiers()
    {
        return $this->belongsToMany(Identifier::class, 'records_identifiers');
    }

    public function getCurrentAttribute()
    {
        return $this->versions->where('status', config('registry.status.current'))->first();
    }
}
