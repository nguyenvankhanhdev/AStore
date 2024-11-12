<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <input type="text" id="user-message" placeholder="Nhập tin nhắn của bạn">
        <button onclick="sendMessage()">Gửi</button>
    </div>
    <div>
        <p>Chatbot trả lời: <span id="chatbot-response"></span></p>
    </div>

</body>
<script>
    async function sendMessage() {
        try {
            const message = document.getElementById('user-message').value;

            const response = await fetch('/chatbot-response', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    message: message
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            document.getElementById('chatbot-response').innerText = data.response;

        } catch (error) {
            console.error("Error:", error);
            document.getElementById('chatbot-response').innerText = "Lỗi: Không thể kết nối với chatbot.";
        }
    }
</script>

</html>
