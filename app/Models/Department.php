<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['head_id','name'];

    public function user() {
        return $this->belongsTo(user::class, 'head_id', 'id');
    }
}