<?php
include("connection.php");

// Initialize default values
$currentUsername = 'admin';

// Get current admin credentials
$sql = "SELECT username, password FROM login WHERE username = 'admin' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $adminData = mysqli_fetch_assoc($result);
    $currentUsername = $adminData['username'] ?? 'admin';
}
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings | Catanduanes State University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Insert the Common CSS here -->
    <style>
           /* Add this to the <head> section of all admin pages */
    :root {
        --transition-duration: 0.4s;
        --transition-easing: cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* Main content transition */
    .content-wrapper {
        opacity: 0;
        transform: translateY(20px);
        animation: contentFadeIn var(--transition-duration) var(--transition-easing) forwards;
        animation-delay: 0.1s;
    }

    @keyframes contentFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Card animations */
    .card {
        opacity: 0;
        transform: translateY(15px);
        transition: all var(--transition-duration) var(--transition-easing);
    }

    .card:nth-child(1) {
        animation: cardFadeIn var(--transition-duration) var(--transition-easing) forwards;
        animation-delay: 0.3s;
    }
    .card:nth-child(2) {
        animation: cardFadeIn var(--transition-duration) var(--transition-easing) forwards;
        animation-delay: 0.4s;
    }
    .card:nth-child(3) {
        animation: cardFadeIn var(--transition-duration) var(--transition-easing) forwards;
        animation-delay: 0.5s;
    }

    @keyframes cardFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Table row animations */
    .table tbody tr {
        opacity: 0;
        transform: translateX(-10px);
        transition: all var(--transition-duration) var(--transition-easing);
    }

    .table tbody tr:nth-child(odd) {
        animation: rowSlideIn var(--transition-duration) var(--transition-easing) forwards;
    }

    .table tbody tr:nth-child(even) {
        animation: rowSlideIn var(--transition-duration) var(--transition-easing) forwards;
    }

    @keyframes rowSlideIn {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Staggered delays for table rows */
    .table tbody tr {
        animation-delay: calc(0.3s + (0.05s * var(--row-index)));
    }

    /* Form elements animation */
    .form-group, .form-control, .btn, .alert {
        opacity: 0;
        transform: translateY(10px);
        transition: all var(--transition-duration) var(--transition-easing);
    }

    /* Page exit transition */
    .page-exit {
        opacity: 0;
        transform: translateY(-10px);
        transition: all var(--transition-duration) var(--transition-easing);
    }
 :root {
    --primary-color: #003366; /* CSU Blue */
    --secondary-color: #f8f9fa;
    --accent-color: #FFD700; /* CSU Gold */
    --dark-color: #343a40;
    --light-color: #ffffff;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --transition-duration: 0.4s;
    --transition-easing: cubic-bezier(0.25, 0.8, 0.25, 1);
}
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 280px;
        background: linear-gradient(180deg, var(--primary-color), #002b57);
        color: var(--light-color);
        padding-top: 30px;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: all 0.3s;
    }

    .sidebar-header {
        padding: 0 20px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 20px;
    }

    .sidebar h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--light-color);
        margin: 0;
        display: flex;
        align-items: center;
    }

    .sidebar h3 i {
        margin-right: 10px;
        color: var(--accent-color);
    }

    .sidebar a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        margin: 5px 15px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .sidebar a i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .sidebar a:hover {
         background-color: rgba(255, 215, 0, 0.2);
        color: var(--light-color);
        transform: translateX(5px);
    }

    .sidebar a.active {
         background-color: var(--accent-color);
    color: var(--primary-color); 
        font-weight: 500;
    }

    .sidebar a.active i {
        color: var(--dark-color);
    }

    .content-wrapper {
        margin-left: 280px;
        padding: 30px;
        transition: all 0.3s;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        padding: 15px 20px;
        border-bottom: none;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .card-body {
        padding: 25px;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th {
        background-color: var(--primary-color);
        color: white;
        padding: 15px;
        font-weight: 500;
        border: none;
    }

    .table td {
        padding: 15px;
        vertical-align: middle;
        border-top: 1px solid #f0f0f0;
    }

    .table tr:hover td {
        background-color: rgba(0, 86, 179, 0.03);
    }

    .btn {
        border-radius: 5px;
        padding: 8px 18px;
        font-weight: 500;
        transition: all 0.3s;
        box-shadow: none !important;
    }

    .btn-primary {
          background-color: var(--primary-color);
    border-color: var(--primary-color);
    }

    .btn-primary:hover {
         background-color: #002b57; /* Darker blue */
    border-color: #002b57;
    }

    .btn-success {
        background-color: var(--success-color);
        border-color: var(--success-color);
    }

    .btn-danger {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .btn-info {
        background-color: var(--info-color);
        border-color: var(--info-color);
    }

    .form-control {
        border-radius: 5px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
    }

    .alert {
        border-radius: 5px;
        padding: 15px;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }

    .badge {
        padding: 5px 10px;
        font-weight: 500;
    }

    .page-title {
        color: var(--primary-color);
        margin-bottom: 25px;
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }

    .page-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 3px;
        background-color: var(--accent-color);
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .sidebar {
            width: 80px;
            overflow: hidden;
        }
        .sidebar h3 span, .sidebar a span {
            display: none;
        }
        .sidebar a i {
            margin-right: 0;
            font-size: 1.3rem;
        }
        .sidebar a {
            justify-content: center;
            padding: 15px 0;
        }
        .content-wrapper {
            margin-left: 80px;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 0;
            padding-top: 60px;
        }
        .content-wrapper {
            margin-left: 0;
        }
    }

        /* Add any settings.php specific styles here */
        .settings-card {
             border-left: 4px solid var(--primary-color);
        }
        
        .password-strength {
            height: 5px;
            background-color: #e9ecef;
            margin-top: 5px;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
              background-color: var(--success-color);
            transition: width 0.3s;
        }
        
        .password-requirements {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="bi bi-building"></i> <span>CICT Admin</span></h3>
        </div>
        <a href="view.php"><i class="bi bi-eye-fill"></i> <span>View FAQs</span></a>
        <a href="create.php"><i class="bi bi-plus-circle-fill"></i> <span>Create FAQs</span></a>
        <a href="update.php"><i class="bi bi-pencil-fill"></i> <span>Update FAQ</span></a>
        <a href="manage.php"><i class="bi bi-chat-left-text-fill"></i> <span>Manage Replies</span></a>
        <a href="settings.php" class="active"><i class="bi bi-gear-fill"></i> <span>Settings</span></a>
        <a href="#" id="logout-btn"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
    </div>

    <div class="content-wrapper">
        <h1 class="page-title"><i class="bi bi-sliders"></i> Admin Settings</h1>
        
        <div class="card settings-card">
            <div class="card-header">
                <i class="bi bi-person-gear"></i> Account Settings
            </div>
            <div class="card-body">
                <form id="adminSettingsForm">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="adminName" class="form-label">Admin Name</label>
                            <input type="text" class="form-control" id="adminName" name="adminName" 
                                   placeholder="Enter admin name" value="<?php echo htmlspecialchars($currentUsername); ?>">
                        </div>
                        

                    <div class="mb-4">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" 
                               placeholder="Enter current password">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" 
                                   placeholder="Enter new password">
                            <div class="password-strength">
                                <div class="password-strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            <div class="password-requirements">
                                Password must be at least 6 characters long
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" 
                                   placeholder="Confirm new password">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script>
    $(document).ready(function() {
        // Password strength indicator
        $('#newPassword').on('input', function() {
            const password = $(this).val();
            let strength = 0;
            
            if (password.length > 0) strength += 20;
            if (password.length >= 6) strength += 30;
            if (password.match(/[A-Z]/)) strength += 20;
            if (password.match(/[0-9]/)) strength += 20;
            if (password.match(/[^A-Za-z0-9]/)) strength += 10;
            
            $('#passwordStrengthBar').css('width', strength + '%');
            
            if (strength < 50) {
                $('#passwordStrengthBar').css('background-color', '#dc3545');
            } else if (strength < 80) {
                $('#passwordStrengthBar').css('background-color', '#ffc107');
            } else {
                $('#passwordStrengthBar').css('background-color', '#28a745');
            }
        });

        // Handle form submission
        $('#adminSettingsForm').on('submit', function(e) {
            e.preventDefault();
            
            const adminName = $('#adminName').val();
            const currentPassword = $('#currentPassword').val();
            const newPassword = $('#newPassword').val();
            const confirmPassword = $('#confirmPassword').val();
            
            if (newPassword !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'New passwords do not match!',
                    confirmButtonColor: '#0056b3',
                    backdrop: `rgba(0,0,0,0.7)`
                });
                return;
            }
            
            if (newPassword && newPassword.length < 6) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Password must be at least 6 characters long!',
                    confirmButtonColor: '#0056b3',
                    backdrop: `rgba(0,0,0,0.7)`
                });
                return;
            }
            
            $.ajax({
                url: 'update_admin.php',
                type: 'POST',
                data: {
                    adminName: adminName,
                    currentPassword: currentPassword,
                    newPassword: newPassword
                },
                success: function(response) {
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Settings updated successfully!',
                            confirmButtonColor: '#0056b3',
                            backdrop: `rgba(0,0,0,0.7)`
                        }).then(() => {
                            location.reload();
                        });
                    } else if (response === 'nochange') {
                        Swal.fire({
                            icon: 'info',
                            title: 'No Changes',
                            text: 'No changes were made to your settings.',
                            confirmButtonColor: '#0056b3',
                            backdrop: `rgba(0,0,0,0.7)`
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Current password is incorrect or update failed!',
                            confirmButtonColor: '#0056b3',
                            backdrop: `rgba(0,0,0,0.7)`
                        });
                    }
                }
            });
        });
    });
    document.getElementById('logout-btn').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Ready to Leave?',
        text: "Are you sure you want to logout?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Logout',
        cancelButtonText: 'Cancel',
        backdrop: `rgba(0,0,0,0.7)`
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('logout.php')  // Create this file
                .then(() => {
                    window.location.href = 'homepage.php';
                });
        }
    });
});
    document.addEventListener('DOMContentLoaded', function() {
        // Set row indexes for staggered animation
        const rows = document.querySelectorAll('.table tbody tr');
        rows.forEach((row, index) => {
            row.style.setProperty('--row-index', index);
        });

        // Set form element animation delays
        const formElements = document.querySelectorAll('.form-group, .form-control, .btn, .alert');
        formElements.forEach((el, index) => {
            el.style.animation = `cardFadeIn var(--transition-duration) var(--transition-easing) forwards`;
            el.style.animationDelay = `${0.3 + (index * 0.05)}s`;
        });

        // Handle navigation with exit transition
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href && !this.classList.contains('active')) {
                    e.preventDefault();
                    document.querySelector('.content-wrapper').classList.add('page-exit');
                    
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 400);
                }
            });
        });
    });

    // For login page redirect to view.php
    function redirectToDashboard() {
        document.querySelector('.login-form-container').classList.add('page-exit');
        setTimeout(() => {
            window.location.href = 'view.php';
        }, 400);
    }
    </script>
</body>
</html>