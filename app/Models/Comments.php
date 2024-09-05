<?php

namespace App\Models;

use App\Http\Controllers\Backend\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Products::class, 'pro_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comments::class, 'cmt_id')->orderBy('created_at', 'DESC')->where('status',0);
    }

    // Phương thức để lấy tất cả các like của một comment
    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class, 'cmt_id');
    }

    // Phương thức để tính tổng số lượng cmt_id trong bảng comment_likes cho comment này
    public function commentLikesCount()
    {
        return $this->commentLikes()->count();
    }

    public function isLikedByUser($userId)
    {
        return $this->commentLikes()->where('user_id', $userId)->exists();
    }
}
