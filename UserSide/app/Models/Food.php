<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    protected $fillable = ['name', 'category_id', 'price', 'image'];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
