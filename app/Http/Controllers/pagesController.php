<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; 

use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\User;
use App\Models\Comment;

class pagesController extends Controller
{

    function __construct(){
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
    }
    public function trangchu(){
        return view('pages.trangchu');
    }

    public function lienhe(){
        return view('pages.lienhe');
    }

    public function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(3);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    public function tintuc($id){
        $tintuc = TinTuc::find($id);
        DB::table('tintuc')->where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]); 
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    public function gioithieu(){
        return view('pages.gioithieu');
    }

    // public function timkiem(Request $request){
    //     $search = $request->search;
    //     $tintuc = TinTuc::where('TieuDe','like',"%$search%")->orWhere('TomTat','like',"%$search%")->orWhere('NoiDung','like',"%$search%")->take(30)->paginate(5);
    //     return view("pages.timkiem",['search'=>$search,'tintuc'=>$tintuc]);
    // }

    public function timkiem(Request $request){
        $search = $request->search;
        return redirect("timkiem/$search");
    }

    public function posttimkiem(Request $request,$search){
        $tintuc = TinTuc::where('TieuDe','like',"%$search%")->orWhere('TomTat','like',"%$search%")->orWhere('NoiDung','like',"%$search%")->take(30)->paginate(5);
        return view("pages.timkiem",['search'=>$search,'tintuc'=>$tintuc]);
    }
}
