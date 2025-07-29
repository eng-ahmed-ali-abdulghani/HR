<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'day', 'date', 'type_id', 'reason_id','actor_id','alternative_id','note','leader_approve','statu_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
    public function alternative()
    {
        return $this->belongsTo(User::class, 'alternative_id');
    }
    public function statu()
    {
        return $this->belongsTo(Statu::class);
    }
}
