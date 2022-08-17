<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['SN','title', 'slug', 'image', 'icon', 'summary', 'parent_id', 'is_parent'];
}
