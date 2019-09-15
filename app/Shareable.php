<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shareable extends Model
{
    protected $table = 'shareable';
    protected $primaryKey  = 'id';
    protected $fillable = ['task_type', 'task_id', 'share_user_id'];

    public function taskable()
    {
        return $this->morphTo();
    }
    public function task()
    {
        return $this->belongsTo('App\Task','task_id');
    }

}
