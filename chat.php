<?php
// Configuration
$db_host = 'localhost';
$db_username = 'your_username';
$db_password = 'your_password';
$db_name = 'your_database';

// Connect to database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to get all messages
function getMessages() {
  $sql = "SELECT * FROM messages";
  $result = $conn->query($sql);
  $messages = array();
  while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
  }
  return $messages;
}

// Function to send a new message
function sendMessage($message) {
  $sql = "INSERT INTO messages (message) VALUES ('$message')";
  $conn->query($sql);
}

// Function to delete old messages
function deleteOldMessages() {
  $sql = "DELETE FROM messages WHERE created_at < DATE_SUB(NOW(), INTERVAL 5 HOUR)";
  $conn->query($sql);
}

// Get all messages
$messages = getMessages();

// Delete old messages
deleteOldMessages();
?>

<!-- HTML and JavaScript code will go here -->

<!-- HTML code -->
<div id="chat-container">
  <h1>Group Chat</h1>
  <ul id="message-list">
    <?php foreach ($messages as $message) { ?>
      <li><?= $message['message'] ?></li>
    <?php } ?>
  </ul>
  <input id="message-input" type="text" placeholder="Type a message...">
  <button id="send-button">Send</button>
</div>

<!-- JavaScript code -->
<script>
  const socket = new WebSocket('wss://yourdomain.com:8080');

  socket.onmessage = (event) => {
    const messageList = document.getElementById('message-list');
    const newMessage = document.createElement('li');
    newMessage.textContent = event.data;
    messageList.appendChild(newMessage);
  };

  document.getElementById('send-button').addEventListener('click', () => {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value;
    socket.send(message);
    messageInput.value = '';
  });
</script>
