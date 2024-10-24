<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use http\Client\Response;
use Illuminate\Http\Request;
use Modules\Order\Events\OrderPlaced;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::where('user_id',auth()->id())->with(['orderitems','orderitems.product'])->orderByDesc('id')->paginate(2);
        return returnApi(['status'=>1,'message'=>'','orders'=>$orders]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'products' => 'present|array',
            'products.*.id' => 'required|numeric|min:0|not_in:0|exists:products,id',
            'products.*.qty' => 'required|numeric|min:0|not_in:0',
        ]);

        if ($validator->fails()) {
             $responseArr['message'] = $validator->errors();;
            return returnApi(['status'=>0,'message'=>$responseArr]);
         }
        foreach ($request->products as $product)
        {
            $productInfo = product::find($product['id']);
            if($productInfo->qty < $product['qty'])
            {
                $responseArr['message'] = 'Product '.$productInfo->name.' is out of stock';
                return returnApi(['status'=>0,'message'=>$responseArr]);
            }
        }
        $order = $this->createOrder($request->products);
        return returnApi(['status'=>1,'message'=>'Order created successfully','order'=>$order]);

    }
    public function createOrder($products)
    {
        $order = Order::create(['user_id'=>auth()->id(),
            'name'=> auth()->user()->name,
            'email'=> auth()->user()->email,
            'phone'=> auth()->user()->phone,
            'order_number'=>uniqid()]);
        $this->createOrderItems($order , $products);
        $this->sendOrderMail($order);
        return $order;
    }
    public function createOrderItems($order , $products)
    {
        $orderTotal = 0 ;
        foreach ($products as $product)
        {
            $productInfo = product::find($product['id']);
            $orderTotal += $product['qty']* $productInfo->price;
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$product['id'],
                'price'=>$productInfo->price,
                'qty'=>$product['qty'],
                'total'=>$product['qty']* $productInfo->price
            ]);
            $this->updateProductQty($product);
        }
        $order->total = $orderTotal;
        $order->save();

        return $order;
    }

    public function updateProductQty($product)
    {
        return product::where('id',$product['id'])->decrement('qty',$product['qty']);
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $order = Order::where('order_number',$id)->where('user_id',auth()->id())->with(['orderitems','orderitems.product'])->first();
        if(!$order)
        {
            $responseArr['message'] = 'Order not found';
            return returnApi(['status'=>0,'message'=>$responseArr]);
        }
        return returnApi(['status'=>1,'message'=>'','order'=>$order]);
    }

    public function sendOrderMail($order)
    {
        $email =  'admin@task.com';
        $emailData = [

            'name' => 'New Order Placed',
            'order'=>$order
        ];

       return (event(new OrderPlaced($email,$emailData)));
    }
}
