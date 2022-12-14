<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $messges = [
            'email.email' => 'Email phải là 1 địa chỉ hợp lệ',
            'email.required' => 'Email không được bỏ trống',
            'password.required' => 'Password không được bỏ trống'
        ];
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ], $messges);
        $username = $request->email; // bien du lieu tu ajax
        $Account = DB::table('users')->where('Email', $username)->first();
        if (!empty($Account)) {
            $password = Hash::check($request->password, $Account->Password);
            if ($password == 1) {
                session(['isLogin' => $Account->id]);
                if (session()->has('isLogin'))
                    return 1;
            };
        }
        return -1;
    }

    public function index()
    {
        $accounts = User::all();
        return response()->json($accounts);
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
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email phải là 1 địa chỉ hợp lệ',
            'email.unique' => 'Email của bạn đã tồn tại',
            'password.required' => 'Password không được để trống ',
            'password.between' => 'Mật khẩu từ 6 đến 20 kí tự',
            'FullName.required' => 'FullName không được bỏ trống',
            'Address.required' => 'Address không được bỏ trống',
            'Phone.required' => 'Phone không được bỏ trống',
            'Phone.regex' => 'Phone không đúng định dạng',
        ];
        $request->validate([
            'email' => 'required | email| unique:users',
            'password' => 'required | between:6,20',
            'FullName' => 'required',
            'Address' => 'required',
            'Phone' => 'required  | regex:/(0)([0-9]{9})/'

        ], $messges);
        $request['password'] = bcrypt($request['password']);
        $request->all();
        $check = DB::table('users')->insert([
            'email' => $request->email,
            'password' => $request->password,
            'FullName' => $request->FullName,
            'Address' => $request->Address,
            'Phone' => $request->Phone
        ]);
        return $check;
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
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
        
        $messges = [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email phải là 1 địa chỉ hợp lệ',
            'email.unique' => 'Email của bạn đã tồn tại',
            'FullName.required' => 'FullName không được bỏ trống',
            'Address.required' => 'Address không được bỏ trống',
            'Phone.required' => 'Phone không được bỏ trống',
            'Phone.regex' => 'Phone không đúng định dạng',
        ];
        $request->validate([
            'email' => 'required | email| unique:users',
            'FullName' => 'required',
            'Address' => 'required',
            'Phone' => 'required  | regex:/(0)([0-9]{9})/'

        ], $messges);
        $request['password'] = bcrypt($request['password']);
        $request->all();
        $check = DB::table('users')->where('id',$id)->update([
            'email' => $request->email,
            'FullName' => $request->FullName,
            'Address' => $request->Address,
            'Phone' => $request->Phone
        ]);
        return $check;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        if(User::find($id)==null)
        return true;
        return false;
    }
}
