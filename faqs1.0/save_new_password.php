<?php
include("connection.php");
session_start();

if (isset($_POST['new_password']) && isset($_SESSION['reset_username'])) {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['reset_username'];

    // (Optional pero recommended) i-hash mo yung password bago i-save
    // $new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password sa database
    $sql = "UPDATE login SET password = ? WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $new_password, $username);
    $success = mysqli_stmt_execute($stmt);

    if ($success) {
        // Start HTML output for the success page
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Password Updated</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                }
                
                body {
                    background: linear-gradient(135deg, #e6f7ff 0%, #f0f9ff 100%);
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    overflow: hidden;
                    position: relative;
                }
                
                .ice-crystal {
                    position: absolute;
                    background: rgba(255, 255, 255, 0.9);
                    clip-path: polygon(
                        50% 0%,
                        70% 30%,
                        100% 50%,
                        70% 70%,
                        50% 100%,
                        30% 70%,
                        0% 50%,
                        30% 30%
                    );
                    filter: blur(1px);
                    animation: float 8s ease-in-out infinite;
                    z-index: 0;
                }
                
                @keyframes float {
                    0%, 100% {
                        transform: translateY(0) rotate(0deg);
                    }
                    50% {
                        transform: translateY(-20px) rotate(5deg);
                    }
                }
                
                .ice-crystal:nth-child(1) {
                    width: 120px;
                    height: 120px;
                    top: 10%;
                    left: 5%;
                    animation-duration: 12s;
                }
                
                .ice-crystal:nth-child(2) {
                    width: 80px;
                    height: 80px;
                    bottom: 15%;
                    left: 20%;
                    animation-duration: 10s;
                }
                
                .ice-crystal:nth-child(3) {
                    width: 150px;
                    height: 150px;
                    top: 30%;
                    right: 10%;
                    animation-duration: 15s;
                }
                
                .ice-crystal:nth-child(4) {
                    width: 60px;
                    height: 60px;
                    bottom: 25%;
                    right: 25%;
                    animation-duration: 8s;
                }
            </style>
        </head>
        <body>
            <!-- Ice crystals -->
            <div class="ice-crystal"></div>
            <div class="ice-crystal"></div>
            <div class="ice-crystal"></div>
            <div class="ice-crystal"></div>
            
            <script>
                Swal.fire({
                    title: "Success!",
                    text: "Password updated successfully!",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Go to Admin",
                    cancelButtonText: "Stay Here",
                    background: "rgba(255, 255, 255, 0.9)",
                    backdrop: `
                        rgba(230, 247, 255, 0.7)
                    `
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php";
                    }
                });
            </script>
        </body>
        </html>';
        session_destroy();
    } else {
        echo '<!DOCTYPE html>
        <html>
        <head>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: "Error!",
                    text: "Failed to update password.",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>';
    }
} else {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: "Invalid Request!",
                text: "Please try the password reset process again.",
                icon: "warning",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "forgot_password.php";
            });
        </script>
    </body>
    </html>';
}
?>