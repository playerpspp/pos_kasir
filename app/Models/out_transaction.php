<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class out_transaction extends Model
{
    protected $table = 'transaction_out';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['price','worker_id'];


    public function worker() {
        return $this->belongsTo(Worker::class, 'worker_id', 'id');
    }
}