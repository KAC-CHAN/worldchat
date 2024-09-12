<?php
// Configuration
$host = 'yourdomain.com';
$port = 8080;

// Create a WebSocket server
$server = new WebSocketServer($host, $port);

// Handle incoming connections
$server->onConnect = function ($conn) {
  echo "New connection from {$conn->remoteAddress}\n";
};

// Handle incoming messages
$server->onMessage = function ($conn, $message) {
  // Broadcast the message to all connected clients
  foreach ($server->connections as $client) {
    $client->send($message);
  }
};

// Start the WebSocket server
$server->run();
