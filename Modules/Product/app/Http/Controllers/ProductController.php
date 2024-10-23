<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Http\Resources\ProductsCollection;
use Modules\Product\Models\product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = (product::where('status',1));
        if($request->has('name')){

            $list= $list->where('name','like','%'.$request->name.'%');
        }
        if($request->has('min_price')){
            $list= $list->where('price','>=', $request->min_price);
        }
         if($request->has('max_price')){
            $list= $list->where('price','<=', $request->max_price);
        }

        $list= $list->orderByDesc('id')->paginate(2);

        return returnApi(['status'=>1,'message'=>'','list'=>new ProductsCollection($list)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
