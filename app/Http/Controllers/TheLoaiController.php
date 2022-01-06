<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhsach(){
        $theloai = TheLoai::all();
        return view("admin.TheLoai.danhsach",['theloai'=>$theloai]);
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view("admin.TheLoai.sua",['theloai'=>$theloai]);
    }

    public function getThem(){
        return view("admin.TheLoai.them");
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
            ]
        );

        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao',"Thêm thành công");
    }

    public function postSua(Request $request,$id){
        $theloai = Theloai::find($id);

        $this->validate($request,
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'        //unique(kiểm tra trùng hay k) : Theloai(bảng nào),Ten(cột nào)
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
            ]
        );

        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao',"Sửa thành công");
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);

        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao',"Xóa thành công");
    }
}
