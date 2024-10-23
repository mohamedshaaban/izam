<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Product\Database\Factories\ConfigurableProductOptionFactory;

class configurableProductOption extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id','option_name'];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
    public function configurableProductVariants()
    {
        return $this->hasMany(configurableProductVariant::class, 'option_id');
    }
}
