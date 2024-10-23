<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
             'id'=>$this->id,
             'name'=>$this->name,
             'sku'=>$this->sku,
             'description'=>$this->description,
             'price'=>$this->price,
             'type'=>$this->type ,
             'qty'=>$this->qty ,
             'status'=>$this->status,
             'images'=>$this->images

         ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'message' => $this->resource['message'],
                'status' => $this->resource['messageStatus'],
            ],
        ];
    }
}
