<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'user_id', 'message', 'image_url', 'is_read'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function scopeRecieved($query,$userId){
        return $query->where('user_id', '!=' , $userId);
    }

    public function scopeUnread($query){
        return $query->where('is_read', false);
    }
}
