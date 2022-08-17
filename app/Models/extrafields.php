<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extrafields extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'value'];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
