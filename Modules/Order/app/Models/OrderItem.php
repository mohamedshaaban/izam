<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\configurableProductOption;
use Modules\Product\Models\configurableProductVariant;
use Modules\Product\Models\product;
use Modules\Product\Models\productImage;

// use Modules\Product\Database\Factories\ProductFactory;

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['order_id','product_id','price','qty','total' ];
    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

}
