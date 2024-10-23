<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\configurableProductOption;
use Modules\Product\Models\configurableProductVariant;
use Modules\Product\Models\productImage;

// use Modules\Product\Database\Factories\ProductFactory;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id','name','email','phone','order_number' , 'total' , 'order_status'];
    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

}
