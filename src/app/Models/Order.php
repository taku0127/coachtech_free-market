<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'postcode', 'address', 'building' , 'payment_method_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function scopeUnreviewed($query,$userId){
        return $query->whereDoesntHave('review', function($query_review) use ($userId) {
            $query_review->fromReviewer($userId);
        });
    }

}
