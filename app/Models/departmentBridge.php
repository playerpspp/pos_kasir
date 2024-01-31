<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class departmentBridge extends Model
{
    protected $table = 'department_bridge';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['worker_id','department_id'];

    public function worker() {
        return $this->belongsTo(Worker::class, 'worker_id', 'id');
    }
    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}