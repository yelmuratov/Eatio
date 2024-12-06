<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];
    use HasFactory;
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
