<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;

class LoaiTinController extends Controller
{
    public function getDanhsach(){
        $loaitin = LoaiTin::all();
        return view("admin.LoaiTin.danhsach",['loaitin'=>$loaitin]);
    }

    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view("admin.LoaiTin.sua",['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view("admin.LoaiTin.them",['theloai'=>$theloai]);
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
                'TheLoai' => 'Bạn chưa chọn thể loại'
            ]
        );

        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao',"Thêm thành công");
    }

    public function postSua(Request $request,$id){
        $loaitin = LoaiTin::find($id);

        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100'        //unique(kiểm tra trùng hay k) : Theloai(bảng nào),Ten(cột nào)
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
            ]
        );

        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao',"Sửa thành công");
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);

        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao',"Xóa thành công");
    }
}
