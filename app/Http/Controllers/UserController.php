<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;

class UserController extends Controller
{
    //
    public function GetLogIn()
    {
        if(session('user_admin')){
            return redirect('admin/');
        }
        return view('admin.login');
    }
    function Login(Request $request)
    {
        try{
            $email=$request->email;
            $pass= $request->password;
            $remember = $request->has('remember') ? true : false;
            $userfind=User::where('username',$email)->where('status',1)->where('role','<>',2)->first();
            if($userfind)
            {
                if($userfind->password==$pass)
                {
                    session(['user_admin' => $userfind->id]);
                    session(['role_admin' => $userfind->role]);
                    session(['username_admin' => $userfind->username]);
                    //session(['username' => $userfind->email]);
                    if($remember)
                    {
                        setcookie("email", $email, time() + 2592000);
                        setcookie("pass", $pass, time() + 2592000);
                    }
                    else{
                        setcookie("email", $email, time());
                        setcookie("pass", $pass, time());
                    }
                    return redirect('admin/')->with('thongbao','Đăng nhập thành công!');
                }
                else{
                    return redirect('admin/log-in')->with('thatbai','Email hoặc mật khẩu không đúng!');
                }
            }
            return redirect('admin/log-in')->with('thatbai','Email hoặc mật khẩu không đúng!');
        }
        catch (\Exception $e)
        {
            return redirect('admin/log-in')->with('thatbai','Email hoặc mật khẩu không đúng!');
        }
    }
    public function PostLogIn(Request $request)
    {
        $remember = $request->has('remember') ? true : false;
        $login=['username'=>$request->get('email'),'password'=>$request->get('password')];

        if(Auth::attempt($login,$remember))
        {
            return redirect('admin/');
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function Home()
    {
        if(session('user_admin'))
        {
            return view('admin.home');
        }
        else{
            return redirect('admin/log-in');
        }
    }
    function LogOut()
    {
        session()->forget('user_admin');
        session()->forget('username_admin');
        session()->forget('role_admin');
        return redirect('admin/log-in');
    }

    public function User()
    {
        if(session('user_admin')){
            $user=User::where('status',1)->where('role','<>',2)->orderBy('id','desc')->get();
            return view('admin.user.user',['user'=>$user]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetUser($id)
    {
        if(session('user_admin')){
            $user=User::find($id);
            return view('admin.user.insert_user',['user'=>$user]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveUser(Request $request)
    {
        if(session('user_admin')){
            try{
                $id=$request->txtid;
                $username=$request->username;
                $email=$request->email;
                $phone=$request->phone;
                $address=$request->address;
                $role=$request->role;
                $pass=$request->pass;
                if($id==0)
                {
                    $exists = User::where('username', $username)
                        ->where('status',1)
                        ->where('role','<>',2)
                        ->exists();
                    if ($exists) {
                        return redirect('admin/user/'.$id)->with('thatbai','Tên đăng nhập đã tồn tại!');
                    }
                    $user=new User;
                    $user->username=$username;
                    $user->email=$email;
                    $user->phone=$phone;
                    $user->address=$address;
                    $user->password=$pass;
                    $user->role=$role;
                    if($request->hasFile('file')){
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($username).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/user/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $user->avatar=$filename;
                    }
                    else{
                        $user->avatar='user.jpg';
                    }
                    if($user->save())
                    {
                        return redirect('admin/user')->with('thongbao','Thêm User thành công!');
                    }
                    else{
                        return redirect('admin/user')->with('thatbai','Thêm User thất bại!');
                    }
                }
                else{
                    $exists = User::where('username', $username)
                        ->where('status',1)
                        ->where('role','<>',2)
                        ->where('id','<>',$id)
                        ->exists();
                    if ($exists) {
                        return redirect('admin/user/'.$id)->with('thatbai','Tên đăng nhập đã tồn tại!');
                    }
                    $user=User::find($id);
                    $user->username=$username;
                    $user->email=$email;
                    $user->phone=$phone;
                    $user->address=$address;
                    $user->role=$role;
                    if($request->hasFile('file')){
                        if(file_exists('images/user/'.$user->avatar) && $user->avatar!='user.jpg')
                        {
                            unlink('images/user/'.$user->avatar);
                        }
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($username).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/user/' . $filename);
                        Image::make($image->getRealPath())->resize(100, 100)->save($path);
                        $user->avatar=$filename;
                    }
                    else{
                        $user->avatar='user.jpg';
                    }
                    $pass_old=$request->pass_old_;
                    $pass_new=$request->pass_;
                    if($pass_new!='' || $pass_new!=null)
                    {
                        if($user->password==$pass_old)
                        {
                            $user->password=$pass_new;
                        }
                        else{
                            return redirect('admin/user/'.$id)->with('thatbai','Mật khẩu cũ không đúng!');
                        }
                    }
                    if($user->save())
                    {
                        return redirect('admin/user')->with('thongbao','Thêm User thành công!');
                    }
                    else{
                        return redirect('admin/user')->with('thatbai','Thêm User thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/user')->with('thatbai','Thêm User thất bại!');
            }

        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteUser($id)
    {
        if(session('user_admin')){
            try{
                $user=User::find($id);
                $user->status=0;
                if($user->save())
                {
                    if(file_exists('images/user/'.$user->avatar) && $user->avatar!='user.jpg')
                    {
                        unlink('images/user/'.$user->avatar);
                    }
                    return redirect('admin/user')->with('thongbao','Xóa Thành công!');
                }
                else{
                    return redirect('admin/user')->with('thatbai','Xóa thất bại!');
                }

            }
            catch (\Exception $e)
            {
                return redirect('admin/user')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function UserFontend()
    {
        if(session('user_admin')){
            $user=User::where('status',1)->where('role',2)->orderBy('id','desc')->get();
            return view('admin.user.user_font_end',['user'=>$user]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetUserFontend($id)
    {
        if(session('user_admin')){
            $user=User::find($id);
            return view('admin.user.insert_user_font_end',['user'=>$user]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveUserFontend(Request $request)
    {
        if(session('user_admin')){
            try{
                $id=$request->txtid;
                $username=$request->username;
                $email=$request->email;
                $phone=$request->phone;
                $address=$request->address;
                $pass=$request->pass;
                if($id==0)
                {
                    $exists = User::where('username', $username)
                        ->where('status',1)
                        ->where('role',2)
                        ->exists();
                    if ($exists) {
                        return redirect('admin/user-font-end/'.$id)->with('thatbai','Tên đăng nhập đã tồn tại!');
                    }
                    $user=new User;
                    $user->username=$username;
                    $user->email=$email;
                    $user->phone=$phone;
                    $user->address=$address;
                    $user->password=$pass;
                    $user->role=2;
                    if($request->hasFile('file')){
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($username).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/user/' . $filename);
                        Image::make($image->getRealPath())->resize(150, 150)->save($path);
                        $user->avatar=$filename;
                    }
                    else{
                        $user->avatar='user.jpg';
                    }
                    if($user->save())
                    {
                        return redirect('admin/user-font-end')->with('thongbao','Thêm User thành công!');
                    }
                    else{
                        return redirect('admin/user-font-end')->with('thatbai','Thêm User thất bại!');
                    }
                }
                else{
                    $exists = User::where('username', $username)
                        ->where('status',1)
                        ->where('role',2)
                        ->where('id','<>',$id)
                        ->exists();
                    if ($exists) {
                        return redirect('admin/user-font-end/'.$id)->with('thatbai','Tên đăng nhập đã tồn tại!');
                    }
                    $user=User::find($id);
                    $user->username=$username;
                    $user->email=$email;
                    $user->phone=$phone;
                    $user->address=$address;
                    $user->role=2;
                    if($request->hasFile('file')){
                        if(file_exists('images/user/'.$user->avatar) && $user->avatar!='user.jpg')
                        {
                            unlink('images/user/'.$user->avatar);
                        }
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($username).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/user/' . $filename);
                        Image::make($image->getRealPath())->resize(150, 150)->save($path);
                        $user->avatar=$filename;
                    }
                    else{
                        $user->avatar='user.jpg';
                    }
                    $pass_old=$request->pass_old_;
                    $pass_new=$request->pass_;
                    if($pass_new!='' || $pass_new!=null)
                    {
                        if($user->password==$pass_old)
                        {
                            $user->password=$pass_new;
                        }
                        else{
                            return redirect('admin/user-font-end/'.$id)->with('thatbai','Mật khẩu cũ không đúng!');
                        }
                    }
                    if($user->save())
                    {
                        return redirect('admin/user-font-end')->with('thongbao','Thêm User thành công!');
                    }
                    else{
                        return redirect('admin/user-font-end')->with('thatbai','Thêm User thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/user-font-end')->with('thatbai','Thêm User thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteUserFontend($id)
    {
        if(session('user_admin')){
            try{
                $user=User::find($id);
                $user->status=0;
                if($user->save())
                {
                    if(file_exists('images/user/'.$user->avatar) && $user->avatar!='user.jpg')
                    {
                        unlink('images/user/'.$user->avatar);
                    }
                    return redirect('admin/user-font-end')->with('thongbao','Xóa Thành công!');
                }
                else{
                    return redirect('admin/user-font-end')->with('thatbai','Xóa thất bại!');
                }

            }
            catch (\Exception $e)
            {
                return redirect('admin/user-font-end')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
}
