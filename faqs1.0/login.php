<?php
include("connection.php");

header('Content-Type: application/json');

if(isset($_POST['user'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];
    session_start();
$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_username'] = $username; // Store the admin username if needed

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $count = mysqli_num_rows($result);

    if($count == 1){
        echo json_encode(['status' => 'success', 'message' => 'Login successful']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
?>