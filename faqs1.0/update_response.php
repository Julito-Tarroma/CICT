<?php
include("connection.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $user_message = $_POST['user_message'] ?? '';
    $bot_reply = $_POST['bot_reply'] ?? '';

    if (!$id || empty($user_message) || empty($bot_reply)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE chatbot_responses SET user_message = ?, bot_reply = ? WHERE id = ?");
    $stmt->bind_param("ssi", $user_message, $bot_reply, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating response: ' . $conn->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>