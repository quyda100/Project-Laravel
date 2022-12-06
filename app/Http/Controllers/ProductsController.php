<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $products = DB::table('products')->get();
         $categories = DB::table('categories')->get();
         return response()->json(['products' =>$products,'categories' => $categories]);
    }
    public function productIndex(){
        $products = DB::table('products')->take(8)->get();
        return response()->json(['products' =>$products]);
    }
    public function getProducts(){
        $id = $_GET['id'];
        $page = $_GET['page'];
        $order = $_GET['order'];
        $count = 0;
        if($id!=0){
        $products = DB::table('products')->where('category_id',$id)->skip(9*($page-1))->take(9);
        $count = DB::table('products')->where('category_id',$id)->count();
        }
        else {
            $products = DB::table('products')->skip(9*($page-1))->take(9);
            $count = DB::table('products')->count();
        }

        if($order == 0){
            $products = $products->orderBy('Price','desc')->get();
        }
        else{
            $products = $products->orderBy('Price','asc')->get();
        }

        $categories = DB::table('categories')->get();
        return response()->json(['products' =>$products,'categories' => $categories,'count'=> $count]);
    }

   
    public function sortDesc(){
        $sort= $_GET['sort'];
        $page = 0;
        //$productPrice;
        if($sort=='0'){
            $productPrice = DB::table('products')->skip(9*($page-1))->take(9)->orderBy('Price','desc')->get();
        }
        else if($sort=='1'){
            $productPrice = DB::table('products')
                    ->skip(9*($page-1))->take(9)
                    ->orderBy('Price', 'asc')
                    ->get();
        }
        return response()->json(['products' => $productPrice]);
    
   }

   public function SearchProduct(){
        $search = $_GET['searchSend'];
        $result= DB::table('products')->where('Name','LIKE','%'.$search.'%')->get();
        return $result;
   }
   public function product()
   {
    $products = DB::table('products')->join('categories','products.category_id','=','categories.id')->orderBy('SKU','asc')->get();
    return response()->json($products);
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
            'id.required' => 'Id không được bỏ trống',
            'id.unique' => 'Id của bạn đã tồn tại',
            'name.required' => 'Name không được để trống ',
            'price.required' => 'Price không được bỏ trống',
            'stock.required' => 'Stock không được bỏ trống',
            'description.required' => 'Description không được bỏ trống'
        ];
        $request->validate([
            'id'=>'required | unique:products',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required'

        ], $messges);
        $request->all();
        $check = DB::table('products')->insert([
            'SKU' => $request->id,
            'Name' => $request->name,
            'description' => $request->description,
            'Stock' => $request->stock,
            'Price' => $request->price,
            'category_id' => $request->category,
            // 'ProductImage' => $request->ProductImage
        ]);
        return $check;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($SKU)
    {
         $Product = DB::table('products')->where('SKU','=',$SKU)->get();
        if (!empty($Product)) {
            return response()->json($Product);
        }
        return -1;
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
        DB::delete('delete users where id = ?', [$id]);
        return true;
    }
}
