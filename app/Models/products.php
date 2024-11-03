<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = True;
    protected $fillable = ['name', 'code','price','amount'];
     
    public function in_detail() {
        return $this->hasMany(in_detail::class);
    }

    public function worker() {
        return $this->belongsTo(Worker::class, 'worker_id', 'id');
    }
}