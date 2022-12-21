<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $order = DB::table('orders')->join('users','orders.user_id','=','users.id')->select(['orders.id','users.FullName','oder_address','oder_phone','total','status'])->get();
         return response()->json($order);
    }
    public function getInfo(){
        $id = session()->get('isLogin');
        $user = DB::table('users')->where('id',$id)->first(['FullName','Phone','Email','Address']);
        $cart = DB::table('carts')->where('user_id',$id)->get();
        if($cart->count()==0) return -2;
        $total = $cart->sum('total');
        return response()->json(['user' => $user,'total' => $total]);
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
        $messges = [
            'Address.required' => 'Địa chỉ không được bỏ trống',
            'FullName.required' => 'Họ và tên không được để trống',
            'Phone.required'=> 'Số điện thoại không được để trống',
            'Phone.regex' => 'Phone không đúng định dạng',
        ];
        $request->validate([
            'Address' => 'required',
            'FullName' => 'required',
            'Phone' => 'required',
            'Phone' => 'required  | regex:/(0)([0-9]{9})/'
        ], $messges);
        $id = session()->get('isLogin');
        $cart = DB::table('carts')->where('user_id',$id)->get();
        $total = $cart->sum('total') + 50000;
        $checkProduct = DB::table('carts')->join('products','products.id','=','carts.product_id')
        ->whereColumn('quantity','>','Stock')->exists();
        if($checkProduct) return -3;
        $request->all();
        $code = Carbon::now()->toDateTimeString();
        $chek = DB::table('orders')->insert([
                'user_id' => $id,
                'code' => $code,
                'oder_address' => $request->Address,
                'oder_phone' => $request->Phone,
                'total' => $total
            ]
            );
        if($chek==1){
            $orderId = DB::table('orders')->where('code',$code)->first();
            foreach($cart as $item){
                $product = DB::table('products')->where('id',$item->product_id)->first();
                DB::table('orderdetails')->insert([
                    'order_id' => $orderId->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'SKU' => $product->SKU,
                    'price' => $item->total
                ]);
                DB::table('products')->where('id',$item->product_id)->update(
                    [
                        'Stock' => $product->Stock - $item->quantity
                    ]
                    );
            }
            $removeCarts = DB::table('carts')->where('user_id',$id)->delete();
            return $removeCarts;
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Order = DB::table('orders')->where('id','=',$id)->get();
        if(!empty($Order)){
            return response()->json($Order);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Order =DB::table('orderdetails')->join('products','products.id','=','product_id')->select(['products.Name','orderdetails.quantity','products.Price'])->get();
        return response()->json($Order);
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
