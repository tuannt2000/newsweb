<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function getXoa($id,$idTinTuc){
        $comment = Comment::find($id);

        $comment->delete();

        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao',"Xóa comment thành công");
    }

    public function postComment($id,Request $request){
        $comment = new Comment;

        $comment->idTinTuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();

        return redirect("tintuc/$id")->with('thongbao','Viết bình luận thành công');
    }
}
