<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['department_id','name'];

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}