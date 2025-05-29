<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMessage = strtolower(trim($_POST["message"]));

    // Check exact matches first
    $stmt = $conn->prepare("SELECT bot_reply FROM chatbot_responses WHERE user_message = ?");
    $stmt->bind_param("s", $userMessage);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row["bot_reply"];
    } else {
        // Check for similar questions in FAQs if no exact match
        $faqStmt = $conn->prepare("SELECT answer FROM faqs WHERE question LIKE ? ORDER BY id LIMIT 1");
        $searchTerm = "%" . $userMessage . "%";
        $faqStmt->bind_param("s", $searchTerm);
        $faqStmt->execute();
        $faqResult = $faqStmt->get_result();

        if ($faqResult->num_rows > 0) {
            $faqRow = $faqResult->fetch_assoc();
            echo $faqRow["answer"];
        } else {
            echo "I'm sorry, I don't understand that question. Please try rephrasing or contact support for more help.";
        }
        
        $faqStmt->close();
    }

    $stmt->close();
    $conn->close();
}
?>