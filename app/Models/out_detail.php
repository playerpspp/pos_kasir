<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class out_detail extends Model
{
    protected $table = 'transaction_out_details';
    protected $primaryKey = 'id';
    public $timestamps = True;
    protected $fillable = ['transaction_id', 'product_id','price','amount'];


    public function products() {
        return $this->belongsTo(products::class, 'product_id', 'id');
    }
}