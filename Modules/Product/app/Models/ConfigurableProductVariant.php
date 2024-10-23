<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Product\Database\Factories\ConfigurableProductVariantFactory;

class configurableProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id','option_id','variant_name','sku','price'];
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function configurable_product_option()
    {
        return $this->belongsTo(configurableProductOption::class, 'option_id');
    }
}
