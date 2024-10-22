<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Product\Database\Factories\ProductImageFactory;

class productImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id','image_path'];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
