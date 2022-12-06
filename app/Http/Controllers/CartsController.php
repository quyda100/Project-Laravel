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
        ->select(['products.*','carts.quantity','carts.total','carts.id as cartId'])
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
        $quantity = $request->quantity + $cartExists->quantity;
        $check = DB::table('carts')->where('id',$cartExists->id)->update(
            [
                'quantity'=> $quantity,
                'total' => $quantity * $productPrice->Price
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
        $request->all();
        if(!is_numeric($request->quantity)) return -4;
        $cart =  DB::table('carts')->where('id',$id)->first();
        $product = DB::table('products')->where('id',$cart->product_id)->first(['id','Price','Stock']);
        if($product->Stock==0) 
            return -1;
        else if($request->quantity<0){
            return -2;
        }
        else if($request->quantity > $product->Stock){
            return -3;
        }
        else{
            $check = DB::table('carts')->where('id',$id)->update(
                [
                    'quantity'=> $request->quantity,
                    'total' => $request->quantity * $product->Price
                ]
            );
            return $check;
        }
        return -4;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = DB::table('carts')->delete($id);
        return $check;
    }
    public function deleteAll(){
        $userId = session()->get('isLogin');
        if(!empty($userId)){
            $check = DB::table('carts')->where('user_id',[$userId])->delete();
            return $check;
        }
        return -1;
    }
    public function plush($id){
        $cart = DB::table('carts')->where('id',$id)->first();
       
        $product = DB::table('products')->where('id',$cart->product_id)->first(['Price','Stock']);
        if($cart->quantity >= $product->Stock) return -1;
        else{
            $check = DB::table('carts')->where('id',$id)->update([
                'quantity' => $cart->quantity + 1,
                'total' => ($cart->quantity + 1)* $product->Price
            ]);
            return $check;
        }
        return -2;
    }
    public function minus($id){
        $cart = DB::table('carts')->where('id',$id)->first();
        $product = DB::table('products')->where('id',$cart->product_id)->first(['Price','Stock']);
        if($cart->quantity <= 1) return -1;
        else{
            $check = DB::table('carts')->where('id',$id)->update([
                'quantity' => $cart->quantity-1,
                'total' => ($cart->quantity-1)* $product->Price
            ]);
            return $check;
        }
        return -2;
    }
}
