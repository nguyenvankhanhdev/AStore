@extends('backend.admin.layouts.master')


@section('content')

    @foreach ($users as $user )
    @php
        $messageCountUnread=\App\Models\Message::countSeenMessagesBySender($user->id);
        $latestMessage=\App\Models\Message::getLatestMessageByUserId($user->id);
        // Gọi hàm lấy tin nhắn cho từng user
        $messages = \App\Models\Message::getMessagesByUserId($user->id);
    @endphp
    <div id="message-list">
    <table>

        @if ($messageCountUnread>0)
            <tr class="unread" data-user-id="{{ $user->id }}" onclick="showChat({{ $user->id }})">
                <td>
                    <div class="user-name">{{ $user->username }}</div>
                    <div class="message-preview">{{ $latestMessage->message }}</div>
                </td>
                <td  class="time">
                    @if ($latestMessage->created_at->isToday())
                        {{ $latestMessage->created_at->format('g:i A') }} <!-- Chỉ hiển thị giờ nếu là hôm nay -->
                    @else
                        {{ $latestMessage->created_at->format('d/m/Y g:i A') }} <!-- Hiển thị ngày và giờ nếu là ngày khác -->
                    @endif
                    <span class="count-unread">(+ {{ $messageCountUnread }})</span>
                    <span class="status-dot red"> </span>

                </td>
            </tr>
        @else
            <tr data-user-id="{{ $user->id }}" onclick="showChat({{ $user->id }})">
                <td>
                    <div class="user-name">{{ $user->username }}</div>
                    <div class="message-preview">{{ $latestMessage->message }}</div>
                </td>
                <td class="time">
                    @if ($latestMessage->created_at->isToday())
                        {{ $latestMessage->created_at->format('g:i A') }} <!-- Chỉ hiển thị giờ nếu là hôm nay -->
                    @else
                        {{ $latestMessage->created_at->format('d/m/Y g:i A') }} <!-- Hiển thị ngày và giờ nếu là ngày khác -->
                    @endif
                </td>
            </tr>
        @endif

    </table>
    </div>
    <div data-user-id="{{ $user->id }}" id="chat-box-{{ $user->id }}" class="chat-box" style="display: none;">
        <div class="chat-header">
            <span class="back-button" onclick="showMessageList()">Back</span>
            <span class="chat-with">{{ $user->username }}</span>
        </div>
        <div id="chat-boxinside-{{ $user->id }}" class="chat-boxinside">
            <!-- Chi tiết tin nhắn với người dùng -->

        @foreach ($messages as $message )
            <div  class="chat-content">
                @if ($message->sender_id==Auth::id())
                    <div data-message-id="{{ $message->id }}" class="message you">
                        {{ $message->message }}
                        <div class="message-time">
                        @if ($message->created_at->isToday())
                            {{ $message->created_at->format('g:i A') }} <!-- Chỉ hiển thị giờ nếu là hôm nay -->
                        @else
                            {{ $message->created_at->format('d/m/Y g:i A') }} <!-- Hiển thị ngày và giờ nếu là ngày khác -->
                        @endif
                        </div>
                    </div>
                @else
                    <div data-message-id="{{ $message->id }}" data-message-time="{{ $message->created_at }}" class="message other">
                        {{ $message->message }}
                        <div class="message-time">
                        @if ($message->created_at->isToday())
                            {{ $message->created_at->format('g:i A') }} <!-- Chỉ hiển thị giờ nếu là hôm nay -->
                        @else
                            {{ $message->created_at->format('d/m/Y g:i A') }} <!-- Hiển thị ngày và giờ nếu là ngày khác -->
                        @endif
                        </div>
                    </div>
                @endif

            </div>
        @endforeach
        </div>


        <div class="chat-input">
            <input type="text" placeholder="Nhập tin nhắn..." id="messageInput-{{ $user->id }}">
            <button onclick="sendMessage({{ $user->id }})">Gửi</button>
        </div>
    </div>
    @endforeach







@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('tr[data-user-id]').forEach(function(row) {
        row.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            showChat(userId); // Gọi hàm showChat với ID người dùng
        });
    });
});






function showChat(userId) {
    // Ẩn tất cả các chat-box
    document.querySelectorAll('.chat-box').forEach(chatBox => {
        chatBox.style.display = 'none';
    });

    // Hiển thị chat-box của người dùng được nhấp vào
    document.getElementById(`chat-box-${userId}`).style.display = 'block';

    // Ẩn danh sách người dùng
    document.getElementById('message-list').style.display = 'none';
    scrollToBottom(`chat-boxinside-${userId}`);
}

function showMessageList() {
    // Hiển thị danh sách người dùng
    document.getElementById('message-list').style.display = 'block';

    // Ẩn tất cả các chat-box
    document.querySelectorAll('.chat-box').forEach(chatBox => {
        chatBox.style.display = 'none';
    });
}

function scrollToBottom(chatBoxId) {
    const chatBox = document.getElementById(chatBoxId);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function sendMessage(userId) {
    // Lấy user_id từ thuộc tính data-user-id
    const chatBox = document.getElementById(`chat-box-${userId}`);
    const user_id = chatBox.getAttribute('data-user-id');

    // Lấy nội dung tin nhắn từ input
    const messageInput = document.getElementById(`messageInput-${userId}`);
    const message = messageInput.value;

    // Kiểm tra nếu nội dung tin nhắn trống
    if (!message) {
        alert("Vui lòng nhập tin nhắn.");
        return;
    }

    // Gửi AJAX request
    $.ajax({
        url: "{{ route('admin.message.store') }}", // Địa chỉ URL để gửi yêu cầu
        method: 'POST',
        data: {
            user_id: user_id, // user_id của người nhận
            message: message, // Nội dung tin nhắn
            _token: '{{ csrf_token() }}' // Token CSRF cho bảo mật
        },
        success: function(response) {
            // Xóa nội dung input sau khi gửi thành công
            messageInput.value = '';

            // Thêm tin nhắn mới vào danh sách tin nhắn với cấu trúc HTML đã cung cấp
            const chatBoxInside = document.getElementById(`chat-boxinside-${userId}`);
            const newMessage = document.createElement('div');
            newMessage.className = 'chat-content';
            newMessage.innerHTML = `
                <div class="message you">
                    ${message}
                    <div class="message-time">
                        ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h23' })}

                    </div>
                </div>
            `;

            // Thêm tin nhắn mới vào cuối danh sách tin nhắn
            chatBoxInside.appendChild(newMessage);

            // Thông báo "Gửi thành công"
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.innerText = 'Gửi thành công';
            successMessage.style.fontSize = '12px';
            successMessage.style.color = 'green';
            successMessage.style.textAlign = 'right';
            successMessage.style.marginTop = '10px';

            // Thêm thông báo vào dưới danh sách tin nhắn
            chatBoxInside.appendChild(successMessage);

            // Cuộn đến tin nhắn mới
            chatBoxInside.scrollTop = chatBoxInside.scrollHeight;

            // Ẩn thông báo sau 2 giây
            setTimeout(() => {
                successMessage.remove();
            }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Có lỗi xảy ra:", error);
            alert('Đã xảy ra lỗi: ' + error);
        }
    });
}

// JavaScript code
</script>
@endpush

@push('scripts')
<script>
   $(document).ready(function() {
    // Lấy ID của người dùng từ data-user-id
    const userId = $('#chat-box-{{ $user->id }}').data('user-id');

    // Hàm để lấy tin nhắn mới
    function fetchNewMessages() {
        // Lấy thời gian của tin nhắn cuối cùng
        //const latestMessageTime = $('#chat-boxinside-{{ $user->id }} .message.other:last').data('message-time');

        // Lấy ID của tin nhắn cuối cùng
        const latestMessageId = $('#chat-boxinside-{{ $user->id }} .message.other:last').data('message-id');

        // Kiểm tra nếu có tin nhắn nào đã được gửi
        if (latestMessageId) {
            $.ajax({
                url: '{{ route("admin.message.getNewMessages") }}', // Đường dẫn đến route
                method: 'GET',
                data: {
                    sender_id: userId,
                    last_id: latestMessageId // Gửi id của tin nhắn cuối cùng
                },
                success: function(response) {
                    // Nếu có tin nhắn mới
                    if (response.messages.length > 0) {
                        // Duyệt qua các tin nhắn mới và thêm vào chat box
                        response.messages.forEach(function(message) {
                            const messageTime = message.created_at; // Thời gian tin nhắn
                            const messageContent = message.message; // Nội dung tin nhắn
                            const messageId = message.id; // ID của tin nhắn mới

                            // Kiểm tra xem tin nhắn đã tồn tại chưa
                            if ($('#chat-boxinside-{{ $user->id }} .message.other[data-message-id="' + messageId + '"]').length === 0) {
                                // Tạo một phần tử cho tin nhắn mới
                                const newMessage = `
                                <div  class="chat-content">
                                    <div data-message-id="${messageId}" data-message-time="${messageTime}" class="message other">
                                        ${messageContent}
                                        <div class="message-time">
                                            ${new Date(messageTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h23' })}

                                        </div>
                                    </div>
                                    </div>
                                `;

                                // Thêm tin nhắn mới vào chat box
                                $('#chat-boxinside-{{ $user->id }}').append(newMessage);
                                const chatBox = $('#chat-boxinside-{{ $user->id }}');
                                chatBox.scrollTop(chatBox[0].scrollHeight);
                            }
                        });
                    }
                },
                error: function(xhr) {
                    console.error("Error fetching new messages:", xhr);
                }
            });
        }
    }

    // Gọi hàm fetchNewMessages mỗi 1.5 giây
    setInterval(fetchNewMessages, 1500);
});

</script>
@endpush
