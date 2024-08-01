<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Comments;

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
            $comment->pro_id = $request->pro_id;
            $comment->user_id = Auth::id(); // Assuming you have authentication

           $comment->save();
           toastr('Created Successfully!', 'success');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $comment = Comments::where('id',$request->id)->firstOrFail();
        $comment->status = 1;
        $comment->save();
        //return redirect()->back()->with('success', 'Bình luận thành công');
        return response(['message' => 'Status has been updated!']);
    }
}
