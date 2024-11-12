@extends('frontend.user.dashboard.layouts.master')

@section('title')
 || Message
@endsection

@section('content')


            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="chat-container">
                    <div id="messageList">
                    @if($messages->isEmpty())
                        <p id="noMessages">Chưa có cuộc trò chuyện</p>
                    @else

                        @foreach ($messages as $message)
                        @if ($message->sender_id==Auth::id())
                         <!-- Tin nhắn của bạn -->
                            <div data-message-id="{{ $message->id }}" class="message you" id="message-{{ $message->id }}">
                                <div class="content">
                                    {{ $message->message }}
                                    <div class="message-time">
                                        @if ($message->created_at->isToday())
                                            {{ $message->created_at->format('g:i A') }} <!-- Chỉ hiển thị giờ nếu là hôm nay -->
                                        @else
                                            {{ $message->created_at->format('d/m/Y g:i A') }} <!-- Hiển thị ngày và giờ nếu là ngày khác -->
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @else
                             <!-- Tin nhắn của người khác -->
                            <div data-message-id="{{ $message->id }}" class="message other" id="message-{{ $message->id }}">
                                <div class="content">
                                    {{ $message->message }}
                                    <div class="message-time">
                                        @if ($message->created_at->isToday())
                                            {{ $message->created_at->format('g:i A') }} <!-- Chỉ hiển thị giờ nếu là hôm nay -->
                                        @else
                                            {{ $message->created_at->format('d/m/Y g:i A') }} <!-- Hiển thị ngày và giờ nếu là ngày khác -->
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach



                    @endif
                </div>
                </div>

                 <!-- Input nhắn tin -->
                 <div class="input-container">
                    <input id="messageInput" type="text" placeholder="Nhập tin nhắn...">
                    <button id="sendButton" type="submit">
                        <i>&#9993;</i> <!-- Biểu tượng lá thư gửi đi -->
                    </button>
                </div>


            </div>



@endsection

@push('scripts')
<script>

window.onload = function() {
    const messageList = document.getElementById('messageList');
    const lastMessage = messageList.lastElementChild; // Lấy tin nhắn cuối cùng
    if (lastMessage) {
        lastMessage.scrollIntoView({ behavior: 'smooth' }); // Cuộn đến tin nhắn cuối cùng
    }
};

$(document).ready(function() {



    // Hàm để lấy tin nhắn mới
    function fetchNewMessages() {
        // Lấy ID của tin nhắn cuối cùng
        const latestMessageId = $('#messageList .message.other:last').data('message-id');

        // Kiểm tra nếu có tin nhắn nào đã được gửi
        if (latestMessageId) {
            $.ajax({
                url: '{{ route("user.message.getNewMessages") }}', // Đường dẫn đến route
                method: 'GET',
                data: {

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
                            if ($('#messageList .message.other[data-message-id="' + messageId + '"]').length === 0) {
                                // Tạo một phần tử cho tin nhắn mới
                                const newMessage = `
                                <div data-message-id="${messageId}" class="message other" id="message-${messageId}">
                                    <div class="content">
                                        ${messageContent}
                                        <div class="message-time">
                                            ${new Date(messageTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true, hourCycle: 'h23' })}
                                        </div>
                                    </div>
                                </div>
                                `;

                                // Thêm tin nhắn mới vào chat box
                                $('#messageList').append(newMessage);

                                // Cuộn xuống đến tin nhắn mới
                                const newMessageElement = $('#messageList .message.other[data-message-id="' + messageId + '"]');
                                newMessageElement[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });

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

// function scrollToLastMessage() {
//     const messageList = document.getElementById('messageList');
//     const lastMessage = messageList.lastElementChild; // Lấy tin nhắn cuối cùng
//     if (lastMessage) {
//         lastMessage.scrollIntoView({ behavior: 'smooth' }); // Cuộn đến tin nhắn cuối cùng
//     }
// }


// document.getElementById('sendButton').addEventListener('click', function(event) {
//     event.preventDefault(); // Ngăn form reload trang

//     // Lấy nội dung từ input
//     const message = document.getElementById('messageInput').value;

//     // Kiểm tra nếu nội dung tin nhắn trống
//     if (!message) {
//         alert("Vui lòng nhập tin nhắn.");
//         return;
//     }

//     // Gửi AJAX request
//     $.ajax({
//         url: "{{ route('user.message.store') }}", // Địa chỉ URL để gửi yêu cầu
//         method: 'POST',
//         data: {
//             message: message, // Nội dung tin nhắn
//             _token: '{{ csrf_token() }}' // Token CSRF cho bảo mật
//         },
//         success: function(response) {
//             // Kiểm tra nếu phản hồi từ server là OK
//             // if (response.status === 'success') {
//                 // Xóa nội dung input sau khi gửi thành công
//                 document.getElementById('messageInput').value = '';
//                 location.reload();
//                 scrollToLastMessage();

//             // } else {
//             //     // Nếu không thành công, hiển thị thông báo lỗi
//             //     alert("Gửi thất bại.");
//             // }
//         },
//         error: function(xhr, status, error) {
//             console.error("Có lỗi xảy ra:", error);
//             alert('Đã xảy ra lỗi: ' + error);
//         }
//     });
// });

function scrollToLastMessage() {
    const messageList = document.getElementById('messageList');
    const lastMessage = messageList.lastElementChild;
    if (lastMessage) {
        lastMessage.scrollIntoView({ behavior: 'smooth' }); // Cuộn đến tin nhắn cuối cùng
    }
}

// document.getElementById('sendButton').addEventListener('click', function(event) {
//     event.preventDefault(); // Ngăn form reload trang

//     // Lấy nội dung từ input
//     const message = document.getElementById('messageInput').value;

//     // Kiểm tra nếu nội dung tin nhắn trống
//     if (!message) {
//         alert("Vui lòng nhập tin nhắn.");
//         return;
//     }

//     // Gửi AJAX request
//     $.ajax({
//         url: "{{ route('user.message.store') }}", // Địa chỉ URL để gửi yêu cầu
//         method: 'POST',
//         data: {
//             message: message, // Nội dung tin nhắn
//             _token: '{{ csrf_token() }}' // Token CSRF cho bảo mật
//         },
//         success: function(response) {
//             // Xóa nội dung input sau khi gửi thành công
//             document.getElementById('messageInput').value = '';

//             // Thêm tin nhắn mới vào danh sách tin nhắn với cấu trúc HTML đúng
//             const messageList = document.getElementById('messageList');
//             const newMessage = document.createElement('div');
//             newMessage.className = 'message you';
//             newMessage.id = `message-${response.message_id}`; // Thiết lập ID cho tin nhắn mới
//             newMessage.innerHTML = `
//                 <div class="content">
//                     ${message}
//                     <div class="message-time">
//                         ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} <!-- Thời gian hiện tại -->
//                     </div>
//                 </div>
//             `;

//             messageList.appendChild(newMessage); // Thêm tin nhắn vào cuối danh sách

//              const successMessage = document.createElement('div');
//             successMessage.className = 'success-message';
//             successMessage.innerText = 'Gửi thành công';
//             successMessage.style.fontSize = '12px';
//             successMessage.style.color = 'green';
//             successMessage.style.textAlign = 'right';
//             successMessage.style.marginTop = '10px';

//             // Thêm thông báo vào dưới danh sách tin nhắn và căn phải
//             messageList.appendChild(successMessage);
//             // Cuộn đến tin nhắn mới
//             scrollToLastMessage();
//             setTimeout(() => {
//                 successMessage.style.display = 'none';
//             }, 2000);
//         },
//         error: function(xhr, status, error) {
//             console.error("Có lỗi xảy ra:", error);
//             alert('Đã xảy ra lỗi: ' + error);
//         }
//     });
// });

// test thêm phần nhắn khi chưa có tin nhắn nào
document.getElementById('sendButton').addEventListener('click', function(event) {
    event.preventDefault(); // Ngăn form reload trang

    // Lấy nội dung từ input
    const message = document.getElementById('messageInput').value;

    // Kiểm tra nếu nội dung tin nhắn trống
    if (!message) {
        alert("Vui lòng nhập tin nhắn.");
        return;
    }

    // Gửi AJAX request
    $.ajax({
        url: "{{ route('user.message.store') }}", // Địa chỉ URL để gửi yêu cầu
        method: 'POST',
        data: {
            message: message, // Nội dung tin nhắn
            _token: '{{ csrf_token() }}' // Token CSRF cho bảo mật
        },
        success: function(response) {
            // Xóa nội dung input sau khi gửi thành công
            document.getElementById('messageInput').value = '';

            // Thêm tin nhắn mới vào danh sách tin nhắn với cấu trúc HTML đúng
            const messageList = document.getElementById('messageList');

            // Xóa thông báo "Chưa có cuộc trò chuyện" nếu tồn tại
            const noMessagesElement = document.getElementById('noMessages');
            if (noMessagesElement) {
                noMessagesElement.remove(); // Xóa phần tử <p> này
            }

            const newMessage = document.createElement('div');
            newMessage.className = 'message you';
            newMessage.id = `message-${response.message_id}`; // Thiết lập ID cho tin nhắn mới
            newMessage.innerHTML = `
                <div class="content">
                    ${message}
                    <div class="message-time">
                        ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} <!-- Thời gian hiện tại -->
                    </div>
                </div>
            `;

            messageList.appendChild(newMessage); // Thêm tin nhắn vào cuối danh sách

            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.innerText = 'Gửi thành công';
            successMessage.style.fontSize = '12px';
            successMessage.style.color = 'green';
            successMessage.style.textAlign = 'right';
            successMessage.style.marginTop = '10px';

            // Thêm thông báo vào dưới danh sách tin nhắn và căn phải
            messageList.appendChild(successMessage);
            // Cuộn đến tin nhắn mới
            scrollToLastMessage();
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Có lỗi xảy ra:", error);
            alert('Đã xảy ra lỗi: ' + error);
        }
    });
});




    </script>
@endpush
