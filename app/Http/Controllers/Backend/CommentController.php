<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CommentDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comments;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CommentDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.comment.index');
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
        //
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
        $comment=Comments::findOrFail($id);
        $comment->status=0;
        $comment->save();
        return redirect()->route('admin.comment.index')->with('success', 'Cập nhật trạng thái bình luận thành công');
        // return response(['status' => 'success','message'=> 'Cập nhật trạng thái bình luận thành công']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment=Comments::findOrFail($id);
        $comment->delete();
        return response(['status' => 'success','message'=> 'Xóa bình luận bị báo cáo thành công']);
    }
}
