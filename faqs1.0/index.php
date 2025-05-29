<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: view.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SecureAuth</title>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #4cc9f0;
            --secondary: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --success: #4cc9f0;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --transition-slow: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            position: relative;
            transform: scale(0.98);
            opacity: 0;
            animation: fadeInScale 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        @keyframes fadeInScale {
            0% {
                transform: scale(0.98);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .login-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-illustration::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            transition: var(--transition-slow);
        }

        .login-illustration:hover::before {
            transform: scale(1.2);
        }

        .login-illustration::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            transition: var(--transition-slow);
        }

        .login-illustration:hover::after {
            transform: scale(1.1);
        }

        .illustration-img {
            width: 80%;
            max-width: 350px;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
            transform: translateY(20px);
            opacity: 0;
            animation: float 6s ease-in-out infinite, fadeInUp 0.8s 0.3s ease-out forwards;
        }

        @keyframes fadeInUp {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .illustration-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-align: center;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s 0.4s ease-out forwards;
        }

        .illustration-text {
            font-size: 1rem;
            font-weight: 300;
            text-align: center;
            max-width: 400px;
            opacity: 0.9;
            line-height: 1.6;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s 0.5s ease-out forwards;
        }

        .login-form-container {
            flex: 1;
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
            transform: translateX(20px);
            opacity: 0;
            animation: fadeInRight 0.8s 0.2s ease-out forwards;
        }

        @keyframes fadeInRight {
            0% {
                transform: translateX(20px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .login-brand {
            position: absolute;
            top: 30px;
            left: 40px;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .login-brand i {
            margin-right: 10px;
            color: var(--secondary);
        }

        .login-header {
            margin-bottom: 40px;
            text-align: center;
            width: 100%;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .login-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 3px;
            transition: var(--transition);
        }

        .login-title:hover::after {
            width: 100%;
        }

        .login-subtitle {
            font-size: 1rem;
            color: var(--gray);
            font-weight: 400;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 8px;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInUp 0.5s 0.6s ease-out forwards;
        }

        .input-field {
            width: 100%;
            padding: 15px 20px;
            font-size: 1rem;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            outline: none;
            transition: var(--transition);
            background-color: #f8f9fa;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInUp 0.5s 0.7s ease-out forwards;
        }

        .input-field:focus {
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }



        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9rem;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInUp 0.5s 0.9s ease-out forwards;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .remember-me label {
            cursor: pointer;
            transition: var(--transition);
        }

        .remember-me label:hover {
            color: var(--primary);
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
            transform: translateX(3px);
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInUp 0.5s 1s ease-out forwards;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition-slow);
        }

        .login-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.4);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0) scale(0.98);
        }

        /* Animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Loading spinner */
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
                min-height: auto;
                max-width: 600px;
            }
            
            .login-illustration {
                padding: 30px;
                border-radius: var(--border-radius) var(--border-radius) 0 0;
            }
            
            .login-form-container {
                padding: 40px;
                border-radius: 0 0 var(--border-radius) var(--border-radius);
            }
            
            .illustration-img {
                width: 60%;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                box-shadow: none;
            }
            
            .login-form-container {
                padding: 30px 20px;
            }
            
            .login-brand {
                top: 20px;
                left: 20px;
                font-size: 1.2rem;
            }
            
            .login-header {
                margin-bottom: 30px;
            }
            
            .illustration-title {
                font-size: 1.8rem;
            }
        }
        
        .center-button-container {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

.back-button {
  display: inline-block;
  padding: 12px 25px;
  color: #003366;
  background-color: #ffcc00;
  border-radius: 30px;
  cursor: pointer;
  text-decoration: none;
  font-weight: bold;
  transition: all 0.3s ease;
  border: none;
  font-size: 1.1em;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}

.back-button:hover {
  background-color: #e6b800;
  transform: translateY(-2px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-illustration">
            <img src="https://cdn-icons-png.flaticon.com/512/3209/3209198.png" alt="Admin Login Illustration" class="illustration-img">
            <h1 class="illustration-title">Admin Portal</h1>
            <p class="illustration-text">Restricted access. Please enter your admin credentials to continue.</p>
        </div>
        <div class="login-form-container">
            <div class="login-brand">
                <i class="fas fa-shield-alt"></i>
                <span>SecureAuth</span>
            </div>
            <div class="login-header">
                <h1 class="login-title">Admin Login</h1>
                <p class="login-subtitle">Enter your admin credentials</p>
            </div>
            <form class="login-form" name="form" id="loginForm" method="POST">
                <div class="input-group">
                    <label for="user" class="input-label">Admin Username</label>
                    <input type="text" id="user" name="user" class="input-field" placeholder="Enter admin username" required>
                </div>
                <div class="input-group">
    <label for="password" class="input-label">Password</label>
    <input type="password" id="password" name="pass" class="input-field" placeholder="Enter your password" required>
    <!-- REMOVED THE EYE ICON COMPLETELY -->
</div>
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
                </div>
                <button type="submit" class="login-btn" id="loginBtn">
                    <span id="btnText">Login</span>
                </button>
                <div class="center-button-container">
  <a class="back-button" href="homepage.php">
    <i class="fas fa-arrow-left"></i> Back to Homepage
  </a>
</div>

            </form>
        </div>
    </div>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
       
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const loginBtn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            loginBtn.disabled = true;
            btnText.innerHTML = '<span class="spinner"></span> Authenticating...';
            
            // Create FormData object
            const formData = new FormData(this);
            
            // Send data to login.php using fetch
            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire({
                        title: 'Admin Access Granted',
                        text: 'Redirecting to admin dashboard...',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        willClose: () => {
                            window.location.href = 'view.php';
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Access Denied',
                        text: data.message || 'Invalid admin credentials. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'Try Again',
                        confirmButtonColor: 'var(--primary)',
                        background: 'white',
                        backdrop: `
                            rgba(67,97,238,0.4)
                            url("/images/nyan-cat.gif")
                            left top
                            no-repeat
                        `
                    }).then(() => {
                        loginBtn.disabled = false;
                        btnText.textContent = 'Login';
                        document.getElementById('password').value = '';
                        document.getElementById('password').focus();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                loginBtn.disabled = false;
                btnText.textContent = 'Login';
                Swal.fire({
                    title: 'Connection Error',
                    text: 'Unable to connect to the server. Please check your internet connection.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'var(--primary)'
                });
            });
        });

        // Show welcome message when page loads
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Admin Portal',
                text: 'Restricted access. Authorized personnel only.',
                icon: 'warning',
                confirmButtonText: 'Continue',
                confirmButtonColor: 'var(--primary)',
                timer: 5000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: true,
                background: 'white',
                backdrop: false
            });
        });

        function showForgotPasswordAlert() {
            Swal.fire({
                title: 'Admin Password Reset',
                html: `
                    <p>Please contact the system administrator to reset your password.</p>
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                        <p style="margin-bottom: 5px;"><i class="fas fa-envelope"></i> <strong>Email:</strong> admin@yourdomain.com</p>
                        <p><i class="fas fa-phone"></i> <strong>Phone:</strong> +1 (555) 123-4567</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: 'var(--primary)',
                background: 'white'
            });
        }
        
    </script>
</body>
</html>