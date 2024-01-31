<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    protected $table = 'ticket_details';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['ticket_id', 'date','user_id','chat'];
    

    public function worker() {
        return $this->belongsTo(Worker::class, 'user_id', 'user_id');
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}