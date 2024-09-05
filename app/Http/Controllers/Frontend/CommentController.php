<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Comments;
use App\Models\CommentLike;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (Auth::id() > 0) {

            $request->validate([
                'content' => ['required', 'string', 'max:255']
            ]);

            $comment = new Comments();
            $comment->content = $request->content;
            $comment->status = 0;
            $comment->cmt_id=$request->cmt_id;
            $comment->pro_id = $request->pro_id;
            $comment->cmt_likes = 0;
            $comment->user_id = Auth::id(); // Assuming you have authentication

           $comment->save();

                // Lưu thành công
            return redirect()->back()->with('success', 'Bình luận thành công');

        }

        else
        {
            return redirect()->route('auth.admin')->with('error','Vui lòng đăng nhập');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {


        $comment = Comments::where('id',$request->cm_id)->firstOrFail();
        $comment->status = 1;
        $comment->save();
        // $page = $request->page;
        // return redirect()->back()->with('success', 'Báo cáo bình luận thành công')->with('page', $page);
        return response()->json([
            'status' => 'success',
            'message' => 'Báo cáo bình luận thành công',

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (Auth::id() > 0) {

            $request->validate([
                'content' => ['required', 'string', 'max:255']
            ]);

            $comment = Comments::where('id',$request->cm_id)->firstOrFail();
            $comment->content = $request->content;



           $comment->save();

                // Lưu thành công
            return redirect()->back()->with('success', 'Sửa bình luận thành công');

        }

        else
        {
            return redirect()->route('auth.admin')->with('error','Vui lòng đăng nhập');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $comment = Comments::where('id',$request->cm_id)->firstOrFail();
        CommentLike::where('cmt_id',$request->cm_id)->delete();
        $comment->delete();

        // return redirect()->back()->with('success', 'Xóa bình luận thành công');
         // Lưu trang hiện tại vào session
        session()->flash('page', $request->page);

        return redirect()->back()->with('success', 'Xóa bình luận thành công');
    }

    public function changeStatus(Request $request)
    {
        $comment = Comments::where('id',$request->cm_id)->firstOrFail();
        $comment->status = 1;
        $comment->save();
        return redirect()->back()->with('success', 'Báo cáo bình luận thành công');
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Báo cáo bình luận thành công',

        // ]);
        //return response(['message' => 'Status has been updated!']);
    }

    public function likeComment(Request $request)
    {
        if (Auth::id() > 0) {

            $userId = Auth::id();
            $commentId = $request->cmt_id;

            // Kiểm tra xem comment like đã tồn tại hay chưa
            $existingLike = CommentLike::where('cmt_id', $commentId)
                                        ->where('user_id', $userId)
                                        ->first();

            $comment = Comments::find($commentId);

            if ($existingLike) {
                // Nếu tồn tại, giảm số lượng likes và xóa dòng trong comment_likes
                $comment->cmt_likes = $comment->cmt_likes - 1;
                $comment->save();

                $existingLike->delete();
                return response()->json([
                    'status' => 'unliked',
                    'likesCount' => $comment->cmt_likes,
                    'message' => 'Bỏ thích bình luận thành công'
                ]);

            } else {
                // Nếu không tồn tại, tăng số lượng likes và thêm dòng mới vào comment_likes
                $comment->cmt_likes = $comment->cmt_likes + 1;
                $comment->save();

                    // Tạo đối tượng CommentLike mới
                $newLike = new CommentLike();
                $newLike->cmt_id = $commentId;
                $newLike->user_id = $userId;
                $newLike->save();

                return response()->json([
                    'status' => 'liked',
                    'likesCount' => $comment->cmt_likes,
                    'message' => 'Đã thích bình luận thành công'
                ]);

            }

        }

        else
        {
            return response()->json([
                'message' => 'Vui lòng đăng nhập để thích bình luận'
            ]);
        }
    }
}
