<?php 
namespace App\Shareable\Model\Shareable;
use Illuminate\Database\Eloquent\Model;
class Shareable extends Model {
protected $table = 'shareable';
protected $primaryKey  = 'id';
protected $fillable = ['note','from','shareable_user_id'];



 }
