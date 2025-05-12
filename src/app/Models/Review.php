<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'reviewer_id', 'reviewee_id', 'rating'];
    const UPDATED_AT = null;

    public function scopeFromReviewer($query, $userId){
        return $query->where('reviewer_id', $userId);
    }
}
