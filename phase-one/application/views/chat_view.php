<!-- chat_view.php -->
<!DOCTYPE html>
<html>
<head>
    <title>WebSocket Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        var conn = new WebSocket('ws://localhost:8080'); // Change the WebSocket URL accordingly

        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            $('#chat').append($('<li>').text(e.data));
        };

        function sendMessage() {
            var message = $('#message').val();
            conn.send(message);
            $('#message').val('');
        }
    </script>
</head>
<body>
    <div id="chat">
        <ul id="messages"></ul>
    </div>
    <input type="text" id="message" />
    <button onclick="sendMessage()">Send</button>
</body>
</html>
