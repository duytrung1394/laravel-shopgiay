<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UserRequest;
use App\User;
class UserController extends Controller
{
    public function getAddUser()
    {
    	return view('admin.user.add_user');
    }
    public function postAddUser(UserRequest $request)
    {
    	$this->validate($request,[
    		'txtEmail' => 'unique:users,email'
    	],[
    		"txtEmail.unique"    => "Email đã tồn tại",
    	]);

		$user           = new User;
        $user->first_name     = $request->txtFirstName;
		$user->last_name     = $request->txtLastName;
		$user->email    = $request->txtEmail;
		$user->password = bcrypt($request->txtPass);
		$user->level    = $request->rdoQuyen;
    	$user->save();
    	return redirect('admin/user/them')->with('message','Thêm thành công');
    }
    public function getListUser()
    {

    	$users = User::all();
        
        // user->notification is array;
        // $user = User::where('level',2)->get();
        // $userx = User::find(24);
        // foreach($userx->notifications as $noti)
        // {            
        //     $data = $noti->data;
        //     $time = $data['billCreatedTime'];
        //     echo $time['date'];
        // }
        // // dd($user->notifications);
    	return view('admin.user.list_user',compact('users'));
    }

    public function getEditUser($id)
    {
    	$user = User::find($id);
    	return view('admin.user.edit_user',compact('user'));
    }

    public function postEditUser(Request $request, $id)
    {
        $this->validate($request,[
            'txtFirstName' => "required|min:2",
            'txtLastName'  => "required|min:2",
            'txtEmail'     => "required|email|unique:users,email,".$id,
        ],[
            'txtFirstName.required' => "Bạn chưa nhập họ",
            'txtFirstName.min'      => "Họ phải có ít nhất 2 kí tự",
            'txtLastName.required'  => "Bạn chưa nhập tên",
            'txtLastName.min'       => "Tên phải có ít nhất 2 kí tự",
            'txtEmail.required'     => "Bạn chưa nhập Email",
            'txtEmail.email'        => "Bạn chưa nhập đúng định dạng Email",
            "txtEmail.unique"       => "Email đã tồn tại",
        ]);

        $user             = User::find($id);
        $user->first_name = $request->txtFirstName;
        $user->last_name  = $request->txtLastName;
        $user->email      = $request->txtEmail;
        $user->level      = $request->rdoQuyen;    
        $user->save();

        return redirect('admin/user/sua/'.$id)->with('message','Sửa thành công');
    }
    public function getAdminLogin()
    {
        if(Auth::guard('admins')->check())
        {
            return redirect('admin');
        }else{
            return view('admin.login');
        }
        
    }
    public function postAdminLogin(Request $request)
    {   
        $this->validate($request,[
            'txtEmail'   => "required",
            'txtPass'    => "required"
        ],[ 
            'txtEmail.required' => "Bạn chưa nhập Email",
            'txtPass.required'  => "Bạn chưa nhập Mật khẩu",
        ]);
        $email = $request->txtEmail;
        $password = $request->txtPass;
        if (Auth::guard('admins')->attempt(['email' => $email, 'password' => $password,'level'=>2,'active'=> 1])) {
            return redirect('admin');
        }else{
            return redirect('admin/dang-nhap')->with('loi','Sai Email hoặc mật khẩu hoặc bạn không có quyền đăng nhập vào trang này');
        }
    }
    public function getAdminLogout()
    {
        if(Auth::guard('admins')->check())
        {
            Auth::guard('admins')->logout();
            return redirect('admin/dang-nhap');
        }
    }
}
