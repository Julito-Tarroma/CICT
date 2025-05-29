<?php
$conn = new mysqli("localhost", "root", "", "admin_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMessage = strtolower(trim($_POST["message"]));

    $stmt = $conn->prepare("SELECT bot_reply FROM chatbot_responses WHERE user_message = ?");
    $stmt->bind_param("s", $userMessage);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row["bot_reply"];
    } else {
        echo "Sorry, I don't understand that.";
    }

    $stmt->close();
    $conn->close();
}
?>
