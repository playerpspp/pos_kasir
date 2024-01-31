<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'department_id','topics_id','priority_id','assign_id','description','status','rating','openDateTime','closeDateTime'];
    

    public function worker() {
        return $this->belongsTo(Worker::class, 'user_id', 'user_id');
    }

    public function assign() {
        return $this->belongsTo(Worker::class, 'assign_id', 'user_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function priority() {
        return $this->belongsTo(Priority::class, 'priority_id', 'id');
    }

    public function TicketDetail()
{
    return $this->hasMany(TicketDetail::class);
}

}