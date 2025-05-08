<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'image', 'name','brand','status_id' ,'description', 'price', 'is_sold'];

    public function likes() {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function order(){
        return $this->hasOne(Order::class);
    }

    public function scopeKeywordSearch($query,$keyword) {
        if(!empty($keyword)){
            $query->where('name','like','%'.$keyword.'%');
        }
    }
}
