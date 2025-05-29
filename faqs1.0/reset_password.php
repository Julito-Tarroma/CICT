<?php
session_start();

if (!isset($_SESSION['reset_username'])) {
    header("Location: forgot_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1a2a3a 0%, #0d1a26 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }
        
        /* Ice-inspired floating elements */
        .floating-ice {
            position: absolute;
            background: rgba(173, 216, 230, 0.7);
            border-radius: 50%;
            filter: blur(1px);
            animation: float linear infinite;
            z-index: 0;
            opacity: 0.8;
        }
        
        .floating-ice:nth-child(1) {
            width: 150px;
            height: 150px;
            top: 10%;
            left: 5%;
            animation: float1 15s linear infinite;
        }
        
        .floating-ice:nth-child(2) {
            width: 100px;
            height: 100px;
            top: 70%;
            left: 15%;
            animation: float2 12s linear infinite;
        }
        
        .floating-ice:nth-child(3) {
            width: 200px;
            height: 200px;
            top: 30%;
            right: 10%;
            animation: float3 18s linear infinite;
        }
        
        .floating-ice:nth-child(4) {
            width: 80px;
            height: 80px;
            bottom: 10%;
            right: 20%;
            animation: float4 10s linear infinite;
        }
        
        @keyframes float1 {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(50px, -30px) rotate(5deg);
            }
            50% {
                transform: translate(100px, 0) rotate(10deg);
            }
            75% {
                transform: translate(50px, 30px) rotate(5deg);
            }
            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }
        
        @keyframes float2 {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(-40px, -20px) rotate(-5deg);
            }
            50% {
                transform: translate(-80px, 0) rotate(-10deg);
            }
            75% {
                transform: translate(-40px, 20px) rotate(-5deg);
            }
            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }
        
        @keyframes float3 {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(0, -50px) rotate(8deg);
            }
            50% {
                transform: translate(0, -100px) rotate(15deg);
            }
            75% {
                transform: translate(0, -50px) rotate(8deg);
            }
            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }
        
        @keyframes float4 {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(30px, -20px) rotate(-3deg);
            }
            50% {
                transform: translate(60px, 0) rotate(-6deg);
            }
            75% {
                transform: translate(30px, 20px) rotate(-3deg);
            }
            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }
        
        .reset-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            transition: all 0.3s ease;
            animation: fadeIn 0.5s ease-out;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .reset-container:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }
        
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
            font-weight: 600;
            font-size: 28px;
        }
        
        input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
        }
        
        input[type="password"]:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
            background: white;
        }
        
        button {
            width: 100%;
            padding: 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #95a5a6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            text-align: center;
            width: 100%;
        }
        
        .back-btn:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Floating ice elements -->
    <div class="floating-ice"></div>
    <div class="floating-ice"></div>
    <div class="floating-ice"></div>
    <div class="floating-ice"></div>
    
    <div class="reset-container">
        <h2>Reset Password</h2>
        <form action="save_new_password.php" method="POST">
            <input type="password" name="new_password" placeholder="Enter New Password" required>
            <button type="submit">Save New Password</button>
            <a href="forgot_password.php" class="back-btn">Back</a>
        </form>
    </div>
</body>
</html>