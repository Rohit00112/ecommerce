<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'price', 'category_id', 'brand_id', 'extrafields_id','slug','summary','features','feature_image','price','discount','status','is_featured','type','stock','extra_fields'];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function brand()
    {
        return $this->belongsTo(brands::class);
    }

    public function extrafields()
    {
        return $this->belongsTo(extrafields::class);
    }
}
