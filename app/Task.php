<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = 'task';
    protected $primaryKey  = 'id';
    protected $fillable = ['content', 'isDone','user_id'];


    public function shareable()
    {
        return $this->morphMany('App\Shareable', 'taskable');
    }
}
