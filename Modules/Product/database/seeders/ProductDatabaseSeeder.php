<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\product;
use Modules\Product\Models\productImage;
use Illuminate\Support\Str;
class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $product =  product::create([
           'name'=>Str::random(10),
           'sku' => Str::random(5),
           'description' =>Str::random(100),
           'price'=>rand(10,1000),
           'qty'=>rand(10,1000),
           'type' =>'simple',
           'status' =>1
        ]);
       productImage::create([
           'product_id'=>$product->id,
           'image_path'=>'/uploads/logo.png'
       ]);    }
}
