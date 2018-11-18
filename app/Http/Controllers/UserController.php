<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | get list of all users 
    |--------------------------------------------------------------------------
    | call view list of users to show all information of users
    | 
    */
    public function getDanhSach(){
    	$user = User::all();
    	return view('admin.user.danhsach', ['user' => $user]);
    }

    /*
    |--------------------------------------------------------------------------
    | call view to write informaion of a new user 
    |--------------------------------------------------------------------------
    | 
    */
    public function getThem(){
    	return view('admin.user.them');
    }

    /*
    |--------------------------------------------------------------------------
    | get information of new user and save in database 
    |--------------------------------------------------------------------------
    | check all information of user. if has error, send message to view 
    | if hasn't error send success message to view 
    | 
    */
    public function postThem(Request $request){
    	$this->validate($request,
            [
                'name'=>'required|min:3',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng.',
                'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự.',
                'email.required'=>'Bạn chưa nhập email.',
                'email.email'=>'Bạn chưa nhập đúng định dạng email.',
                'email.unique'=>'Email đã tồn tại',
                'password.required'=>'Bạn chưa nhập mật khẩu.',
                'password.min'=>'Mật khẩu phải có ít nhất 3 kí tự.',
                'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự.',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu.',
                'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng.',
            ]);

    	$user = new User();
    	$user->full_name =$request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->quyen = $request->quyen;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
        $user->save();
        return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');
    }

    /*
    |--------------------------------------------------------------------------
    | get view to edit information of a user
    |--------------------------------------------------------------------------
    | input: $id is indentify of a user
    | get view to edit information of user $id 
    | 
    */
    public function getSua($id) {
    	$user = User::find($id);
    	return view('admin.user.sua', ['user'=>$user]);
    }

    /*
    |--------------------------------------------------------------------------
    | get new information of user and save to database
    |--------------------------------------------------------------------------
    | find user by $id and check all information, if new information has error
    | send error message to view, if not save new information to database
    | 
    */
    public function postSua(Request $request, $id){
    	$user = User::find($id);
    	$this->validate($request,
            [
                'name'=>'required|min:3',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng.',
                'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự.',
            ]);

    	$user->full_name =$request->name;
    	$user->quyen = $request->quyen;
    	$user->phone = $request->phone;
    	$user->address = $request->address;

    	if($request->changePassword == "on"){
    		$this->validate($request,
            [
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password',
            ],
            [
                'password.required'=>'Bạn chưa nhập mật khẩu.',
                'password.min'=>'Mật khẩu phải có ít nhất 3 kí tự.',
                'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự.',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu.',
                'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng.',
            ]);
    		$user->password = bcrypt($request->password);
    	}

        $user->save();

        return redirect('admin/user/sua/'.$id)->with('thongbao', 'Sửa thành công');
    }

    /*
    |--------------------------------------------------------------------------
    | remove a user from database 
    |--------------------------------------------------------------------------
    | find user by $id and remove user, send success message to view
    | 
    */
    public function getXoa($id){
    	$user = User::find($id);
    	$user->delete();

    	return redirect('admin/user/danhsach')->with('thongbao', 'Xóa thành công');
    }

}
