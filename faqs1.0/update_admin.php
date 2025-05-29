<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminName = $_POST['adminName'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    
    // First verify the current password using the original admin username
    $originalUsername = 'admin'; // Or fetch from session if you have one
    $verifySql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $verifyStmt = mysqli_prepare($conn, $verifySql);
    mysqli_stmt_bind_param($verifyStmt, "ss", $originalUsername, $currentPassword);
    mysqli_stmt_execute($verifyStmt);
    $result = mysqli_stmt_get_result($verifyStmt);
    
    if (mysqli_num_rows($result) == 0) {
        echo "error";
        exit;
    }
    
    // Current password is correct, proceed with update
    // Update both username and password
    $updateSql = "UPDATE login SET username = ?, password = ? WHERE username = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    
    if ($updateStmt) {
        mysqli_stmt_bind_param($updateStmt, "sss", $adminName, $newPassword, $originalUsername);
        mysqli_stmt_execute($updateStmt);
        
        if (mysqli_stmt_affected_rows($updateStmt) > 0) {
            echo "success";
        } else {
            echo "nochange"; // No rows were updated
        }
        
        mysqli_stmt_close($updateStmt);
    } else {
        echo "error";
    }
    
    mysqli_close($conn);
}
?>