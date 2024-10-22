<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Product\Database\Factories\ProductFactory;

class product extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','sku','description','price','type'];

    public function images()
    {
        return $this->hasMany(productImage::class, 'product_id');
    }

    public function configurableProductOptions()
    {
        return $this->hasMany(configurableProductOption::class, 'product_id');
    }
    public function configurableProductVariants()
    {
        return $this->hasMany(configurableProductVariant::class, 'product_id');
    }
}
