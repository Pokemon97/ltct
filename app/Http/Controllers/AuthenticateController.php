<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;

class AuthenticateController extends Controller
{

    //admin
    /*
    |--------------------------------------------------------------------------
    | get admin login page
    |-------------------------------------------------------------------------- 
    | 
    */
    public function getDangNhapAdmin(){
        return view('admin.login');
    }

    /*
    |--------------------------------------------------------------------------
    | check username, password of admin to login 
    |--------------------------------------------------------------------------
    | receive username, password from admin login page
    | check username, password
    | login to system
    | if has error send error message to view
    | if not show list kind of products
    | 
    */
    public function postDangNhapAdmin(Request $request){
        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required|min:3|max:32',
            ],[
                'email.required'=>'Bạn chưa nhập email.',
                'password.min'=>'Mật khẩu không dưới 3 kí tự.',
                'password.max'=>'Mật khẩu tối đa 32 kí tự.',
            ]);
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('loi','Đăng nhập không thành công.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | admin logout  
    |--------------------------------------------------------------------------
    | logout from system and rediect to admin login page 
    | 
    */
    public function getDangXuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }

    //normal user
    /*
    |--------------------------------------------------------------------------
    | get user login page 
    |-------------------------------------------------------------------------- 
    | 
    */
    public function getLogin(){
        return view('pages.login');
    }

    /*
    |--------------------------------------------------------------------------
    | check username, password to login 
    |--------------------------------------------------------------------------
    | receive username, password from user login page
    | check username, password to login
    | if has error show error message
    | if not show success message 
    | 
    */
    public function postLogin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email Không đúng định dạng',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự'
            ]
        );

        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect('index');
        }
        else{
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'Đăng nhập thất bại!']);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | get signup page
    |-------------------------------------------------------------------------- 
    | 
    */
    public function getSignup(){
        return view('pages.signup');
    }

    /*
    |--------------------------------------------------------------------------
    | receive information of new account and save to database 
    |--------------------------------------------------------------------------
    | check account and show error if had
    | creat new user with received information and save to database 
    | 
    */
    public function postSignup(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email Không đúng định dạng',
                'email.unique'=>'Email đã được sử dụng',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                're_password.required'=>'Chưa nhập lại mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'fullname.required'=>'Chưa điền tên',
            ]
        );

        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();

        return redirect()->back()->with('success', 'Đăng ký thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | show user information 
    |--------------------------------------------------------------------------
    | show information of authenticated user  
    | 
    */
    public function getPersonalInformation(){
        return view('pages.personal_information');
    }

    /*
    |--------------------------------------------------------------------------
    | get change infomation page 
    |--------------------------------------------------------------------------
    | 
    */
    public function getChangeInformation(){
        return view('pages.change_information');
    }

    /*
    |--------------------------------------------------------------------------
    | update new information to database 
    |--------------------------------------------------------------------------
    | check new information
    | if has error show error message
    | if not save new information and show success message
    | 
    */
    public function postChangeInformation(Request $req){
        $this->validate($req,
            [
                'fullname'=>'required',
            ],
            [
                'fullname.required'=>'Chưa điền tên',
            ]
        );

        Auth::user()->full_name = $req->fullname;
        Auth::user()->phone = $req->phone;
        Auth::user()->address = $req->address;
        Auth::user()->save();

        return redirect()->back()->with('success', 'Sửa thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | get change password page 
    |--------------------------------------------------------------------------
    | 
    */
    public function getChangePassword(){
        return view('pages.change_password');
    }

    /*
    |--------------------------------------------------------------------------
    | update new password to database 
    |--------------------------------------------------------------------------
    | check password is correct, new password and re_password same
    | if has error show error message
    | if not save new information and show success message
    | 
    */
    public function postChangePassword(Request $req){
        $this->validate($req,
            [
                'password'=>'required|min:6',
                're_password'=>'required|same:password',
                'old_password'=>'required',
            ],
            [
                're_password.required'=>'Chưa nhập mật khẩu',
                'password.required'=>'Bạn chưa nhập mật khẩu mới',
                'password.min'=>'Mật khẩu mới ít nhất 6 ký tự',
                're_password.required'=>'Chưa nhập lại mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
            ]
        );

        if(!Auth::attempt(['email'=> Auth::user()->email, 'password'=>$req->old_password]))
            return redirect('change_password')->with('loi','Mật khẩu không đúng.');

        Auth::user()->password = bcrypt($req->password);
        Auth::user()->save();

        return redirect()->back()->with('success', 'Đổi mật khẩu thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | get user logout page
    |-------------------------------------------------------------------------- 
    | 
    */
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home-page');
    }
}
