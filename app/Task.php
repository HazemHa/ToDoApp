<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = 'notes';
    protected $primaryKey  = 'id';
    protected $fillable = ['content', 'isDone'];
}
