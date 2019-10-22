<?php

namespace App\Registry\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable = ['schema', 'record_id', 'data', 'status', 'hash'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->setAttribute('hash', $model->hash($model->data));
        });
    }

    /**
     * @param $payload
     * @return string
     */
    public static function hash($payload)
    {
        return md5($payload);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }
}
