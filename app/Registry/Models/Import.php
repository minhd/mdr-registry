<?php

namespace App\Registry\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $casts = [
        'params' => 'array',
        'info' => 'array'
    ];

    public static $STATUS_RUNNING = 'RUNNING';
    public static $STATUS_PENDING = 'PENDING';
    public static $STATUS_COMPLETED = 'COMPLETED';

    public function datasource()
    {
        return $this->belongsTo(DataSource::class, 'data_source_id');
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    /**
     * run this task immediately until completion
     * TODO implement
     */
    public function run()
    {

    }

    /**
     * validate a task parameters
     * TODO implement
     */
    public function validate()
    {

    }

    public function saveTaskData(string $key, array $content)
    {
        if (! $this->info) $this->info = [];
        $this->info = array_merge($this->info, [$key => $content]);
        $this->save();
        return $this;
    }
}
