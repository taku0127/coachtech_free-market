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

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function comments(){
        return $this->belongsToMany(User::class, 'comments')->withPivot('comment');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
