<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = session()->get('isLogin');
        $carts = DB::table('carts')
        ->join('products','products.id','=','carts.product_id')
        ->select(['products.*','carts.quantity'])
        ->where('user_id',$userId)->get();
        $total = $carts->sum('total');
        return response()->json(['carts'=>$carts,'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = session()->get('isLogin');
        $productPrice = DB::table('products')->where('id',$request->idProduct)->first();
        $cartExists =  DB::table('carts')->where('user_id',$userId)->where('product_id',$request->idProduct)->first();
        if($productPrice->Stock==0) return -2;
       if(empty($cartExists)){
        $request->all();
        $check = DB::table('carts')->insert(
            [
                'product_id' => $request->idProduct,
                'user_id' => $userId,
                'quantity'=> $request->quantity,
                'color' => 1,
                'size' => 2,
                'total' => ($request->quantity * $productPrice->Price)
            ]
        );
            return $check;
       }
       else{
        if($cartExists->quantity >= $productPrice->Stock) return -3;
        $check = DB::table('carts')->where('id',$cartExists->id)->update(
            [
                'quantity'=> $request->quantity + $cartExists->quantity,
                'total' => ($request->quantity * $productPrice->Price)
            ]
        );
            return $check;
       }
        return -1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
