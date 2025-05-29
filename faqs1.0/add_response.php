<?php
include("connection.php");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMessage = strtolower(trim($_POST['user_message']));
    $botReply = $_POST['bot_reply'];
    
    $stmt = $conn->prepare("INSERT INTO chatbot_responses (user_message, bot_reply) VALUES (?, ?)");
    $stmt->bind_param("ss", $userMessage, $botReply);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>