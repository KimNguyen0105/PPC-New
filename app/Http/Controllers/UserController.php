<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function GetLogIn()
    {
        if(Auth::check()){
            return redirect('admin/home');
        }
        return view('admin.login');
    }
    public function PostLogIn(Request $request)
    {
//        $this->validate($request,[
//           'email'=>'required',
//            'password'=>'required|min:6'],
//            [
//                'email.required'=>'Chưa nhập email',
//            'password.required'=>'Chưa nhập pass',
//            'password.min'=>'pass phải lớn hơn 6'
//        ]);
        $remember = $request->has('remember') ? true : false;
        $login=['username'=>$request->get('email'),'password'=>$request->get('password')];

        if(Auth::attempt($login,$remember))
        {
            return redirect('admin/home');
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function Home()
    {
        if(Auth::check()){
            return view('admin.home');
        }
        else{
            return redirect('admin/log-in');
        }
    }
    function LogOut()
    {
        Auth::logout();
        return redirect('admin/log-in');
    }
}
