<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            transform: scale(1);
            opacity: 1;
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }
        
        .container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            animation: borderGrow 2s infinite alternate;
        }
        
        @keyframes borderGrow {
            0% { width: 0%; left: 0; right: auto; }
            100% { width: 100%; left: 0; right: 0; }
        }
        
        h2 {
            color: #2d3748;
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-size: 1.8rem;
        }
        
        form {
            display: flex;
            flex-direction: column;
        }
        
        input {
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.9);
        }
        
        input:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.2);
        }
        
        button {
            background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: linear-gradient(to right, #3a8fd9 0%, #00d9e6 100%);
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
        
        .floating-balls {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }
        
        .ball {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-1000px) rotate(720deg); }
        }
    </style>
</head>
<body>
    <div class="floating-balls">
        <?php for($i=0; $i<15; $i++): ?>
            <div class="ball" style="
                width: <?= rand(30, 100) ?>px;
                height: <?= rand(30, 100) ?>px;
                left: <?= rand(0, 100) ?>%;
                top: <?= rand(100, 120) ?>%;
                animation-delay: <?= rand(0, 10) ?>s;
                animation-duration: <?= rand(10, 30) ?>s;
            "></div>
        <?php endfor; ?>
    </div>
    
    <div class="container">
        <h2>Forgot Password (Admin)</h2>
        <form action="verify_secret.php" method="POST">
            <input type="text" name="username" placeholder="Enter Admin Username" required>
            <input type="text" name="secret" placeholder="Enter Secret Code" required>
            <button type="submit">Verify</button>
            <a href="index.php" class="back-btn">Back</a>
        </form>
    </div>
</body>
</html>