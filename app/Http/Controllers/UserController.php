<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getDanhsach(){
        $user = User::all();
        return view("admin.User.danhsach",['user'=>$user]);
    }

    public function getSua($id){
        $user = User::find($id);
        return view("admin.User.sua",['user'=>$user]);
    }

    public function getThem(){
        return view("admin.User.them");
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|unique:users,name|min:3',
                'Email' => 'required|email|unique:users,email',
                'Password' => 'required|min:3|max:32',
                'PasswordAgain' => 'required|same:Password',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên user',
                'Email.required' => 'Bạn chưa nhập email',
                'Email.email' => 'Bạn chưa nhập đúng định dạng email',
                'Password.required' => 'Bạn chưa nhập Password',
                'PasswordAgain.required' => 'Bạn chưa nhập lại Password',
                'PasswordAgain.same' => 'Mật khẩu không trùng nhau',
                'Ten.unique' => 'Tên user đã tồn tại',
                'Email.unique' => 'Email đã tồn tại',
                'Ten.min' => 'Tên user có độ dài từ lớn hơn 3 ký tự',
                'Password.max' => 'Mật khẩu có độ dài từ 3 đến 32 ký tự',
                'Password.min' => 'Mật khẩu có độ dài từ 3 đến 32 ký tự',
            ]
        );

        $user = new User;
        $user->name = $request->Ten;
        $user->email = $request->Email;
        $user->password = bcrypt($request->Password);
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao',"Thêm thành công");
    }

    public function postSua(Request $request,$id){
        $user = User::find($id);

        $this->validate($request,
            [
                'Ten' => 'required|unique:users,name|min:3',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên user',
                'Ten.unique' => 'Tên user đã tồn tại',
                'Ten.min' => 'Tên user có độ dài từ lớn hơn 3 ký tự',
            ]
        );

        $user->name = $request->Ten;
        $user->quyen = $request->quyen;
        if(isset($request->changePassword)){
            $this->validate($request,
                [
                    'Password' => 'required|min:3|max:32',
                    'PasswordAgain' => 'required|same:Password',
                ],
                [
                    'Password.required' => 'Bạn chưa nhập Password',
                    'PasswordAgain.required' => 'Bạn chưa nhập lại Password',
                    'PasswordAgain.same' => 'Mật khẩu không trùng nhau',
                    'Password.max' => 'Mật khẩu có độ dài từ 3 đến 32 ký tự',
                    'Password.min' => 'Mật khẩu có độ dài từ 3 đến 32 ký tự',
                ]
            );

            $user->password = bcrypt($request->Password);
        }
        $user->save();

        return redirect('admin/user/sua/'.$id)->with('thongbao',"Sửa thành công");
    }

    public function getXoa($id){
        $user = User::find($id);

        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao',"Xóa thành công");
    }

    public function getdangnhapAdmin(){
        return view("admin.login");
    }

    public function postdangnhapAdmin(Request $request){
        $this->validate($request,
            [
                'Email' => 'required',
                'Password' => 'required',
            ],
            [
                'Password.required' => 'Bạn chưa nhập Password',
                'Email.required' => 'Bạn chưa nhập Email',
            ]
        );

        if(Auth::attempt(['email' => $request->Email, 'password' => $request->Password])){       //đăng nhập
            return redirect('admin/loaitin/danhsach');
        }else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập thất bại');
        }
    }

    public function getlogout(){
        Auth::logout();
        return view("admin.login");
    }

    public function getdangnhap(){
        return view("pages.dangnhap");
    }

    public function postdangnhap(Request $request){
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'password.required' => 'Bạn chưa nhập Password',
                'email.required' => 'Bạn chưa nhập Email',
            ]
        );

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){       //đăng nhập
            return redirect('trangchu');
        }else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập thất bại');
        }
    }

    public function dangxuat(){
        Auth::logout();
        return redirect("trangchu");
    }

    public function getdangky(){
        return view("pages.dangky");
    }

    public function postdangky(Request $request){
        $this->validate($request,
            [
                'Username' => 'required',
                'Email' => 'required|email|unique:users,email',
                'Password' => 'required|min:6|max:12',
                'PasswordAgain' => 'required|same:Password',
            ],
            [
                'Username.required' => 'Bạn chưa nhập họ tên',
                'Password.required' => 'Bạn chưa nhập Password',
                'Password.max' => 'Password có độ dài 6 đến 12 ký tự',
                'Password.min' => 'Password có độ dài 6 đến 12 ký tự',
                'Email.required' => 'Bạn chưa nhập Email',
                'Email.email' => 'Bạn chưa đúng Email',
                'Email.unique' => 'Email đã tồn tại',
                'PasswordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'PasswordAgain.same' => 'Nhập lại mật khẩu sai',
            ]
        );

        $user = new User;
        $user->name = $request->Username;
        $user->email = $request->Email;
        $user->password = bcrypt($request->Password);
        $user->quyen = 0;
        $user->save();

        return redirect('dangky')->with('thongbao',"Đăng ký thành công");
    }

    public function getnguoidung(){
        return view("pages.nguoidung");
    }

    public function postnguoidung(Request $request){
        $this->validate($request,
            [
                'name' => 'required|',
            ],
            [
                'name.required' => 'Bạn chưa nhập họ tên',
            ]
        );

        $user = Auth::user();
        $user->name = $request->name;

        if(isset($request->checkpassword)){
            $this->validate($request,
                [
                    'password' => 'required|min:6|max:12',
                    'passwordAgain' => 'required|same:password',
                ],
                [
                    'password.required' => 'Bạn chưa nhập Password',
                    'password.max' => 'Password có độ dài 6 đến 12 ký tự',
                    'password.min' => 'Password có độ dài 6 đến 12 ký tự',
                    'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same' => 'Nhập lại mật khẩu sai',
                ]
            );

            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('nguoidung')->with('thongbao',"Sửa thành công");
    }
}
