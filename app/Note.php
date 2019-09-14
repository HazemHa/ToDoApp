<?php 
namespace App\Note\Model\Note;
use Illuminate\Database\Eloquent\Model;
class Note extends Model {
protected $table = 'notes';
protected $primaryKey  = 'id';
protected $fillable = ['content','isDone'];



 }
