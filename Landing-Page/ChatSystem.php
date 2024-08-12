<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Chatbox with Image Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .chatbox {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            background-color: #ffffff;
        }
        .chat-message {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 0.5rem;
            max-width: 80%;
        }
        .chat-message.you {
            background-color: #e9f7ef;
            align-self: flex-end;
        }
        .chat-message.other {
            background-color: #f1f0f0;
            align-self: flex-start;
        }
        .chat-input-group {
            position: relative;
        }
        .upload-btn {
            position: absolute;
            top: 50%;
            right: 2.5rem;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h5>Chatbox</h5>
        </div>
        <div class="card-body d-flex flex-column chatbox" id="chatbox">
            <!-- Chat messages will be appended here -->
        </div>
        <div class="card-footer">
            <form id="chatForm" onsubmit="return false;">
                <div class="input-group chat-input-group">
                    <input type="text" class="form-control" id="messageInput" placeholder="Type a message...">
                    <button class="btn btn-primary" type="button" onclick="sendMessage()">Send</button>
                    <button class="btn btn-secondary upload-btn" type="button" onclick="document.getElementById('imageUpload').click();">
                        Upload Image
                    </button>
                    <input type="file" id="imageUpload" style="display: none;" accept="image/*" onchange="uploadImage(this)">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies (Popper.js and jQuery) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    const websocketUrl = "ws://your-websocket-server-url"; // Replace with your WebSocket server URL
    let ws = new WebSocket(websocketUrl);

    ws.onopen = function () {
        console.log("WebSocket connection established");
    };

    ws.onmessage = function (event) {
        const data = JSON.parse(event.data);
        if (data.type === 'text') {
            appendMessage(data.sender, data.message);
        } else if (data.type === 'image') {
            appendImage(data.sender, data.imageSrc);
        }
    };

    ws.onclose = function () {
        console.log("WebSocket connection closed");
    };

    ws.onerror = function (error) {
        console.log("WebSocket error: ", error);
    };

    function sendMessage() {
        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value.trim();
        if (message) {
            const data = {
                type: 'text',
                sender: 'You',
                message: message
            };
            ws.send(JSON.stringify(data));
            messageInput.value = '';
            appendMessage('You', message);
        }
    }

    function appendMessage(sender, message) {
        const chatbox = document.getElementById('chatbox');
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', sender === 'You' ? 'you' : 'other');
        messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    function uploadImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const data = {
                    type: 'image',
                    sender: 'You',
                    imageSrc: e.target.result
                };
                ws.send(JSON.stringify(data));
                appendImage('You', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function appendImage(sender, imageSrc) {
        const chatbox = document.getElementById('chatbox');
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', sender === 'You' ? 'you' : 'other');
        messageElement.innerHTML = `<strong>${sender}:</strong><br><img src="${imageSrc}" alt="Uploaded Image" class="img-fluid" style="max-width: 200px;">`;
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }
</script>

</body>
</html>
