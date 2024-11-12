@extends('backend.admin.layouts.master')


@section('content')

<div class="list-user-message">
    <div id="new-user" class="new-user" style="display:none">
        <table class="table-message-new-user">
            <tr class="check-new-user">
                <td>
                    <div class="button-container"> <!-- Thêm div này để sử dụng Flexbox -->
                        <button id="refreshButton" class="btn-refresh">Refresh &#8635</button>
                        <p class="new-user-text">Có người dùng mới</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>


    @foreach ($users as $user )

    @php
        $messageCountUnread=\App\Models\Message::countSeenMessagesBySender($user->id);
        $latestMessage=\App\Models\Message::getLatestMessageByUserId($user->id);
        $messages = \App\Models\Message::getMessagesByUserId($user->id);
    @endphp

    <div id="message-list" class="message-list">
    <table class="table-message">

        @if ($messageCountUnread>0)
            <tr  class="unread" data-user-id="{{ $user->id }}" onclick="showChat({{ $user->id }})">
                <td>
                    <div class="user-name">{{ $user->username }}</div>
                    <div  data-message-id="{{ $latestMessage->id }}" class="message-preview">{{ $latestMessage->message }}</div>
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
            <tr class="read" data-user-id="{{ $user->id }}" onclick="showChat({{ $user->id }})">
                <td>
                    <div class="user-name">{{ $user->username }}</div>
                    <div data-message-id="{{ $latestMessage->id }}" class="message-preview">{{ $latestMessage->message }}</div>
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
    <div data-user-id="{{ $user->id }}" id="chat-box-{{ $user->id }}" class="chat-box-custom" style="display: none;">
        <div class="chat-header">
            <span class="back-button" onclick="showMessageList()">Back</span>
            <span class="chat-with">{{ $user->username }}</span>
        </div>
        <div id="chat-boxinside-{{ $user->id }}" class="chat-boxinside">
            <!-- Chi tiết tin nhắn với người dùng -->

        @foreach ($messages as $message )
            <div  class="chat-content-custom">
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





</div>

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

// sự kiện xem có người dùng mới nào nhắn tin hay không
$(document).ready(function() {
    function checkNewUserMessages() {
        // Lấy tất cả user_id từ tất cả các chat box
        let userIds = [];
        $('.chat-box-custom').each(function() {
            const userId = $(this).data('user-id'); // Lấy user_id từ thuộc tính data
            if (userId) {
                userIds.push(userId);
            }
        });

        // Nếu không có user_id nào thì không gửi yêu cầu
        if (userIds.length === 0) {
            $('#new-user').hide(); // Ẩn thông báo nếu không có user
            return;
        }

        $.ajax({
            url: "{{ route('admin.message.takeNewUserMessage') }}" , // Đường dẫn đến API của bạn
            type: 'POST',
            data: { user_ids: userIds }, // Gửi mảng user_id
            success: function(response) {
                // Xử lý phản hồi từ server
                const excludedUsers = response; // Giả sử phản hồi là danh sách user_id không nằm trong danh sách đã gửi
                const count = excludedUsers.length;

                if (count > 0) {
                    $('#new-user').show(); // Hiển thị thông báo có người dùng mới
                    $('.new-user-text').text(`Có ${count} người dùng mới nhắn tin.`); // Cập nhật số lượng người dùng mới
                } else {
                    $('#new-user').hide(); // Ẩn thông báo nếu không có người dùng mới
                }
            },
            error: function(xhr, status, error) {
                console.error("Có lỗi xảy ra:", error); // Ghi lại lỗi nếu có
            }
        });
    }

    // Gọi hàm kiểm tra mỗi 2 giây
    setInterval(checkNewUserMessages, 1500);

    $('#refreshButton').on('click', function() {
        location.reload(); // Tải lại trang
    });
});





function showChat(userId) {
    // Ẩn tất cả các chat-box
    $('.chat-box-custom').hide();

    // Ẩn tất cả các message-list
    $('.message-list').hide();

    // Hiển thị chat-box của người dùng được nhấp vào
    $(`#chat-box-${userId}`).show();

    // Cuộn xuống cuối phần chat
    scrollToBottom(`chat-boxinside-${userId}`);

    // Gửi yêu cầu AJAX để cập nhật trạng thái tin nhắn
    $.ajax({
        url: "{{ route('admin.message.changeStatus') }}",
        method: 'POST',
        data: {
            user_id: userId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            // Kiểm tra xem có cần bỏ dấu chấm đỏ không
            const messageRow = $(`tr[data-user-id="${userId}"]`);
            if (messageRow.hasClass('unread')) {
                // Thay đổi class thành 'read'
                messageRow.removeClass('unread').addClass('read');

                // Cập nhật giao diện
                messageRow.find('.status-dot').remove() // Giả sử bạn có class 'green' cho dấu chấm đã đọc
                messageRow.find('.count-unread').remove(); // Xóa số lượng tin nhắn chưa đọc
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating message status:', error);
        }
    });
}


function showMessageList() {
    // Hiển thị danh sách người dùng
    document.querySelectorAll('#message-list').forEach(messageList => {
        messageList.style.display = 'block';
    });


    // Ẩn tất cả các chat-box
    document.querySelectorAll('.chat-box-custom').forEach(chatBox => {
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
            newMessage.className = 'chat-content-custom';
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
            //Cập nhật tin nhắn mới vào hàng chat box trong danh sách
            const messageRow = $('tr[data-user-id="' + userId + '"]');
            messageRow.find('.message-preview').text(message);
            messageRow.find('.time').html(`
              ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h23' })}
            `);


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
//     // sắp xếp thứ tự danh sách các user
 // Hàm sắp xếp message-list
 function sortMessages() {
    const container = $(".list-user-message"); // Lấy container bao quanh tất cả message-list
    const messages = $(".message-list").detach(); // Tách các phần tử message-list ra khỏi DOM

    // Sắp xếp message-list theo yêu cầu
    const sortedMessages = messages.toArray().sort((a, b) => {
        const aRow = $(a).find("tr");
        const bRow = $(b).find("tr");

        const aIsUnread = aRow.hasClass("unread");
        const bIsUnread = bRow.hasClass("unread");

        // Sắp xếp unread lên trên read
        if (aIsUnread && !bIsUnread) return -1;
        if (!aIsUnread && bIsUnread) return 1;

        // Nếu cả hai đều là unread, sắp xếp theo data-message-id giảm dần
        if (aIsUnread && bIsUnread) {
            const messageIdA = parseInt($(a).find(".message-preview").data("message-id"), 10);
            const messageIdB = parseInt($(b).find(".message-preview").data("message-id"), 10);

            return messageIdB - messageIdA; // Sắp xếp giảm dần theo data-message-id
        }

        return 0;
    });

      // Thêm lại các message-list theo thứ tự đã sắp xếp vào container mà không làm mất chatbox
      messages.each(function() {
        $(this).remove(); // Xóa từng message-list cũ
    });

    // Thêm lại các message-list theo thứ tự đã sắp xếp vào container
    container.append(sortedMessages);
}

// Thiết lập setInterval để chạy hàm sortMessages mỗi giây
setInterval(sortMessages, 500);


// test đến count unread và gắn vào
$(document).ready(function() {
    // Hàm để lấy tin nhắn mới cho từng người dùng
    function fetchNewMessages() {
        $('.chat-box-custom').each(function() {
            const chatBoxDiv = $(this);
            const userId = chatBoxDiv.data('user-id');
            const latestMessageId = chatBoxDiv.find('.message.other:last').data('message-id');

            if (latestMessageId) {
                $.ajax({
                    url: '{{ route("admin.message.getNewMessages") }}', // Đường dẫn đến route
                    method: 'GET',
                    data: {
                        sender_id: userId,
                        last_id: latestMessageId // Gửi id của tin nhắn cuối cùng
                    },
                    success: function(response) {
                        if (response.messages.length > 0) {
                            response.messages.forEach(function(message) {
                                const messageTime = message.created_at;
                                const messageContent = message.message;
                                const messageId = message.id;

                                if (chatBoxDiv.find('.message.other[data-message-id="' + messageId + '"]').length === 0) {
                                    // Tạo phần tử cho tin nhắn mới
                                    const newMessage = `
                                    <div class="chat-content-custom">
                                        <div data-message-id="${messageId}" data-message-time="${messageTime}" class="message other">
                                            ${messageContent}
                                            <div class="message-time">
                                                ${new Date(messageTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h23' })}
                                            </div>
                                        </div>
                                    </div>
                                    `;

                                    // Thêm tin nhắn mới vào chat box
                                    const chatBoxInside = $('#chat-boxinside-' + userId);
                                    chatBoxInside.append(newMessage);
                                    chatBoxInside.scrollTop(chatBoxInside[0].scrollHeight);

                                    // Cập nhật tin nhắn mới vào hàng chat box trong danh sách
                                    const messageRow = $('tr[data-user-id="' + userId + '"]');
                                    messageRow.find('.message-preview')
                                        .text(messageContent)            // Cập nhật nội dung tin nhắn
                                        .attr('data-message-id', messageId); // Cập nhật thuộc tính data-message-id
                                    messageRow.find('.time').html(`
                                        ${new Date(messageTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h23' })}
                                    `);

                                    // Kiểm tra trạng thái hiển thị của chat box
                                    if (!chatBoxDiv.is(':visible')) {
                                        if (messageRow.hasClass('read')) {
                                            messageRow.removeClass('read').addClass('unread');
                                        }

                                        // Gọi AJAX để lấy số lượng tin nhắn chưa đọc
                                        $.ajax({
                                            url: '{{ route("admin.message.takeCountUnseenMessage") }}',
                                            method: 'GET',
                                            data: {
                                                user_id: userId
                                            },
                                            success: function(countResponse) {
                                                // Xóa chấm trạng thái và số lượng tin nhắn chưa đọc cũ
                                                messageRow.find('.status-dot').remove();
                                                messageRow.find('.count-unread').remove();

                                                // Thêm chấm trạng thái và số lượng tin nhắn chưa đọc mới
                                                messageRow.find('.time').append(`<span class="count-unread">(+ ${countResponse.count})</span>`);
                                                messageRow.find('.time').append('<span class="status-dot red"></span>');
                                            },
                                            error: function(xhr) {
                                                console.error("Error fetching unseen message count:", xhr);
                                            }
                                        });
                                    }
                                    else
                                    {
                                        $.ajax({
                                            url: "{{ route('admin.message.changeStatus') }}",
                                            method: 'POST',
                                            data: {
                                                user_id: userId,
                                                _token: '{{ csrf_token() }}'
                                            },
                                            success: function(response) {

                                            },
                                            error: function(xhr, status, error) {
                                                console.error('Error updating message status:', error);
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error("Error fetching new messages:", xhr);
                    }
                });
            }
        });
    }

    // Gọi hàm fetchNewMessages mỗi 1.5 giây
    setInterval(fetchNewMessages, 2000);
});




</script>
@endpush
