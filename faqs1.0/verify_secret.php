<?php
include("connection.php");
session_start();

// Block direct access to this script
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.0 404 Not Found");
    exit('<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 Not Found</title>
        <style>
            body {
                background: #f8f9fa;
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                color: #343a40;
            }
            .error-container {
                text-align: center;
                padding: 2rem;
                border-radius: 8px;
                background: white;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            h1 {
                font-size: 3rem;
                margin-bottom: 1rem;
                color: #dc3545;
            }
            p {
                font-size: 1.2rem;
                margin-bottom: 2rem;
            }
            a {
                color: #007bff;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>404</h1>
            <p>Page not found</p>
            <p><a href="forgot_password.php">Return to password reset</a></p>
        </div>
    </body>
    </html>');
}

if (isset($_POST['username']) && isset($_POST['secret'])) {
    $username = $_POST['username'];
    $secret = $_POST['secret'];

    // Secret code na ikaw lang ang may alam
    $correct_secret = "IAmSuperAdmin123";

    // Check kung tamang admin username at tamang secret
    if ($username === "julito" && $secret === $correct_secret) {
        $_SESSION['reset_username'] = $username;
        
        // Success HTML with SweetAlert
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Access Granted</title>
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
                
                .ice-diamond {
                    position: absolute;
                    background: rgba(255, 255, 255, 0.9);
                    clip-path: polygon(
                        50% 0%,
                        80% 50%,
                        50% 100%,
                        20% 50%
                    );
                    filter: blur(1px);
                    animation: sparkle 2s ease-in-out infinite;
                    z-index: 0;
                }
                
                @keyframes sparkle {
                    0%, 100% {
                        opacity: 0.8;
                        transform: scale(1);
                    }
                    50% {
                        opacity: 1;
                        transform: scale(1.1);
                    }
                }
                
                .ice-diamond:nth-child(1) {
                    width: 120px;
                    height: 120px;
                    top: 15%;
                    left: 10%;
                    animation-delay: 0.1s;
                }
                
                .ice-diamond:nth-child(2) {
                    width: 80px;
                    height: 80px;
                    bottom: 20%;
                    left: 25%;
                    animation-delay: 0.3s;
                }
                
                .ice-diamond:nth-child(3) {
                    width: 150px;
                    height: 150px;
                    top: 35%;
                    right: 15%;
                    animation-delay: 0.2s;
                }
            </style>
        </head>
        <body>
            <!-- Sparkling ice diamonds -->
            <div class="ice-diamond"></div>
            <div class="ice-diamond"></div>
            <div class="ice-diamond"></div>
            
            <script>
                Swal.fire({
                    title: "Access Granted!",
                    text: "Secret code verified successfully!",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Continue to Password Reset",
                    background: "rgba(255, 255, 255, 0.9)",
                    backdrop: `
                        rgba(230, 247, 255, 0.7)
                    `,
                    timer: 3000,
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = "reset_password.php";
                    }
                });
            </script>
        </body>
        </html>';
        exit();
    } else {
        // Error HTML with SweetAlert
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Access Denied</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                }
                
                body {
                    background: linear-gradient(135deg, #fff0f0 0%, #ffe6e6 100%);
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    overflow: hidden;
                    position: relative;
                }
                
                .ice-shard {
                    position: absolute;
                    background: rgba(255, 255, 255, 0.7);
                    clip-path: polygon(
                        50% 0%,
                        100% 50%,
                        50% 100%,
                        0% 50%
                    );
                    filter: blur(0.5px);
                    animation: glitch 1.5s ease-in-out infinite;
                    z-index: 0;
                }
                
                @keyframes glitch {
                    0%, 100% {
                        opacity: 0.7;
                        transform: rotate(0deg) scale(1);
                    }
                    25% {
                        transform: rotate(2deg) scale(1.05);
                    }
                    50% {
                        opacity: 0.9;
                        transform: rotate(-1deg) scale(0.95);
                    }
                    75% {
                        transform: rotate(1deg) scale(1.02);
                    }
                }
                
                .ice-shard:nth-child(1) {
                    width: 100px;
                    height: 100px;
                    top: 10%;
                    left: 15%;
                    animation-delay: 0.1s;
                }
                
                .ice-shard:nth-child(2) {
                    width: 70px;
                    height: 70px;
                    bottom: 15%;
                    left: 20%;
                    animation-delay: 0.3s;
                }
                
                .ice-shard:nth-child(3) {
                    width: 130px;
                    height: 130px;
                    top: 30%;
                    right: 10%;
                    animation-delay: 0.2s;
                }
            </style>
        </head>
        <body>
            <!-- Broken ice shards -->
            <div class="ice-shard"></div>
            <div class="ice-shard"></div>
            <div class="ice-shard"></div>
            
            <script>
                Swal.fire({
                    title: "Access Denied!",
                    text: "Invalid username or secret code!",
                    icon: "error",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Try Again",
                    background: "rgba(255, 255, 255, 0.9)",
                    backdrop: `
                        rgba(255, 200, 200, 0.4)
                    `
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "forgot_password.php";
                    }
                });
            </script>
        </body>
        </html>';
        exit();
    }
} else {
    // If POST request but missing parameters
    header("HTTP/1.0 404 Not Found");
    exit('<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 Not Found</title>
        <style>
            body {
                background: #f8f9fa;
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                color: #343a40;
            }
            .error-container {
                text-align: center;
                padding: 2rem;
                border-radius: 8px;
                background: white;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            h1 {
                font-size: 3rem;
                margin-bottom: 1rem;
                color: #dc3545;
            }
            p {
                font-size: 1.2rem;
                margin-bottom: 2rem;
            }
            a {
                color: #007bff;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>404</h1>
            <p>Page not found</p>
            <p><a href="forgot_password.php">Return to password reset</a></p>
        </div>
    </body>
    </html>');
}
?>