<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_id');
    }

    public static function countSeenMessagesBySender($senderId)
    {
        return self::where('sender_id', $senderId)
                    ->where('seen', 1)
                    ->count();
    }

    public static function getMessagesByUserId($userId)
    {
        return self::where(function ($query) use ($userId) {
                        $query->where('sender_id', $userId)
                              ->orWhere('received_id', $userId);
                    })
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public static function getLatestMessageByUserId($userId)
    {
        return self::where(function ($query) use ($userId) {
                        $query->where('sender_id', $userId)
                            ->orWhere('received_id', $userId);
                    })
                    ->latest('created_at') // Lấy theo thời gian mới nhất
                    ->first(); // Lấy một tin nhắn duy nhất (tin nhắn cuối cùng)
    }

    public static function getMessagesAfterlastId($senderId, $receiverId, $LastId)
    {
        return self::where(function ($query) use ($senderId, $receiverId) {
                            $query->where('sender_id', $senderId)
                                ->where('received_id', $receiverId);
                        })
                        ->where('id', '>', $LastId) // Chỉ lấy tin nhắn sau thời gian latestMessage
                        ->orderBy('created_at', 'asc') // Sắp xếp theo thời gian tăng dần
                        ->get();
    }
}
