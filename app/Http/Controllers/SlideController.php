<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slide;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    public function getDanhsach(){
        $slide = Slide::all();
        return view("admin.Slide.danhsach",['slide'=>$slide]);
    }

    public function getSua($id){
        $slide = Slide::find($id);
        return view("admin.Slide.sua",['slide'=>$slide]);
    }

    public function getThem(){
        return view("admin.Slide.them");
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|unique:Slide,Ten|min:3|max:100',
                'link' => 'required|unique:Slide,link',
                'NoiDung' => 'required'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên slide',
                'Ten.unique' => 'Tên slide đã tồn tại',
                'Ten.min' => 'Tên slide có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên slide có độ dài từ 3 đến 100 ký tự',
                'link.required' => 'Bạn chưa nhập link',
                'link.unique' => 'Link đã tồn tại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
            ]
        );

        $slide = new Slide;
        $slide->Ten = $request->Ten;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("images/slide".$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("images/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }else{
            $slide->Hinh = "";
        }
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->link;
        $slide->save();

        return redirect('admin/slide/them')->with('thongbao',"Thêm thành công");
    }

    public function postSua(Request $request,$id){
        $slide = Slide::find($id);

        $this->validate($request,
            [
                'Ten' => 'required|unique:Slide,Ten|min:3|max:100',
                'link' => 'required|unique:Slide,link',
                'NoiDung' => 'required'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên slide',
                'Ten.unique' => 'Tên slide đã tồn tại',
                'Ten.min' => 'Tên slide có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên slide có độ dài từ 3 đến 100 ký tự',
                'link.required' => 'Bạn chưa nhập link',
                'link.unique' => 'Link đã tồn tại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
            ]
        );

        $slide->Ten = $request->Ten;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("images/slide".$Hinh)){
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("images/slide",$Hinh);
            unlink("images/slide/".$slide->Hinh);
            $slide->Hinh = $Hinh;
        }
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->link;
        $slide->save();

        return redirect('admin/slide/sua/'.$id)->with('thongbao',"Sửa thành công");
    }

    public function getXoa($id){
        $slide = Slide::find($id);

        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao',"Xóa thành công");
    }
}
