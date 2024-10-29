<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id=Auth::id();
        $messages = Message::where(function($query) use ($user_id) {
            $query->where('sender_id', $user_id)
                  ->orWhere('received_id', $user_id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return view('frontend.user.dashboard.message', compact('messages'));
    }

    public function getNewMessages(Request $request)
    {
        $senderId = 1;
        $receiverId = Auth::id();
        $lastId = $request->last_id;

        // Lấy các tin nhắn mới hơn tin nhắn đã cho
        $messages = Message::getMessagesAfterlastId($senderId, $receiverId, $lastId);

        return response()->json(['messages' => $messages]);
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
        $request->validate([
            'message' => ['required', 'string', 'max:255']
        ]);

        try {
            $message = new Message();
            $message->message = $request->message;
            $message->seen = 1;
            $message->sender_id = Auth::id();
            $message->received_id = 1;

            $message->save();

            // return response()->json(['success' => true, 'message' => 'Bình luận thành công']);
            return redirect()->back();

        } catch (\Exception $e) {
            // return response()->json(['success' => false, 'error' => 'Có lỗi xảy ra.'], 500);
            return redirect()->back();

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
}
