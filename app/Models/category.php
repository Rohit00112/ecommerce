<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['SN','title', 'slug', 'image', 'icon', 'summary', 'parent_id','uploader_id', 'is_parent'];

    public function subCategories()
    {
        return $this->hasMany(category::class, 'parent_id');
    }

    public function extraFields(){
        return $this->hasMany(extrafields::class, 'category_id');
    }
}
