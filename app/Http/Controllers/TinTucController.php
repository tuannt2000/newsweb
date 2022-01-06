<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use Illuminate\Support\Str;

class TinTucController extends Controller
{
    public function getDanhsach(){
        $tintuc = TinTuc::all();
        return view("admin.TinTuc.danhsach",['tintuc'=>$tintuc]);
    }

    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view("admin.TinTuc.sua",['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view("admin.TinTuc.them",['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3|max:100',        //unique(kiểm tra trùng hay k) : Theloai(bảng nào),Ten(cột nào)
                'TomTat' => 'required',
                'NoiDung' => 'required',
                'LoaiTin' => 'required',
                'TheLoai' => 'required',
                'Hinh' => 'required'
            ],
            [
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TieuDe.min' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
                'TieuDe.max' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'LoaiTin.required' => 'Bạn chưa chọn loại tin',
                'Hinh.required' => 'Bạn chưa nhập file ảnh',
                'TheLoai.required' => 'Bạn chưa chọn thể loại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
            ]
        );

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("images/tintuc".$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("images/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao',"Thêm thành công");
    }

    public function postSua(Request $request,$id){
        $tintuc = TinTuc::find($id);

        $this->validate($request,
            [
                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3|max:100',        //unique(kiểm tra trùng hay k) : Theloai(bảng nào),Ten(cột nào)
                'TomTat' => 'required',
                'NoiDung' => 'required',
                'LoaiTin' => 'required',
                'TheLoai' => 'required',
                'Hinh' => 'required'
            ],
            [
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TieuDe.min' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
                'TieuDe.max' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'LoaiTin.required' => 'Bạn chưa chọn loại tin',
                'Hinh.required' => 'Bạn chưa nhập file ảnh',
                'TheLoai.required' => 'Bạn chưa chọn thể loại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
            ]
        );

        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("images/tintuc".$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("images/tintuc",$Hinh);
            unlink("images/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        
        $tintuc->save();

        return redirect('admin/tintuc/sua/'.$id)->with('thongbao',"Sửa thành công");
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);

        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao',"Xóa thành công");
    }
}
