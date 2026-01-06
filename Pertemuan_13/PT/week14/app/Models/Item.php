<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{    
    protected $fillable = ['name', 'stock', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
