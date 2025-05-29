<?php
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
    <title>Admin FAQ Dashboard | Catanduanes State University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    /* Add this to the <head> section of all admin pages */
    :root {
        --transition-duration: 0.4s;
        --transition-easing: cubic-bezier(0.25, 0.8, 0.25, 1);
        --primary-color: #003366; /* CSU Blue */
        --secondary-color: #f8f9fa;
        --accent-color: #FFD700; /* CSU Gold */
        --dark-color: #343a40;
        --light-color: #ffffff;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --info-color: #17a2b8;
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
        color: var(--primary-color);
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
        background-color: #002b57;
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

    .faq-count {
        background-color: var(--accent-color);
        color: var(--primary-color);
        padding: 3px 8px;
        border-radius: 50px;
        font-size: 0.8rem;
        margin-left: 8px;
    }
    
    .search-box {
        position: relative;
        margin-bottom: 0;
    }
    
    .search-box i {
        position: absolute;
        left: 15px;
        top: 12px;
        color: #6c757d;
    }
    
    .search-box input {
        padding-left: 40px;
        width: 250px;
    }

    .card-header-content {
        display: flex;
        align-items: center;
    }

    .no-results {
        display: none;
        text-align: center;
        padding: 20px;
        font-style: italic;
        color: #6c757d;
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
</style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="bi bi-building"></i> <span>CICT Admin</span></h3>
        </div>
        <a href="view.php" class="active"><i class="bi bi-eye-fill"></i> <span>View FAQs</span></a>
        <a href="create.php"><i class="bi bi-plus-circle-fill"></i> <span>Create FAQs</span></a>
        <a href="update.php"><i class="bi bi-pencil-fill"></i> <span>Update FAQ</span></a>
        <a href="manage.php"><i class="bi bi-chat-left-text-fill"></i> <span>Manage Replies</span></a>
        <a href="settings.php"><i class="bi bi-gear-fill"></i> <span>Settings</span></a>
        <a href="#" id="logout-btn"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
    </div>

    <div class="content-wrapper">
        <h1 class="page-title">FAQ Management</h1>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-header-content">
                    <i class="bi bi-list-check me-2"></i>
                    <span>Current FAQs</span>
                    <span class="faq-count">
                        <?php 
                        include("connection.php"); 
                        echo $conn->query("SELECT COUNT(*) FROM faqs")->fetch_row()[0]; 
                        $conn->close(); 
                        ?>
                    </span>
                </div>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="search-input" class="form-control" placeholder="Search FAQs...">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="40%">Question</th>
                                <th width="40%">Answer</th>
                                <th width="15%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="faq-table-body">
                            <?php
                            include("connection.php");
                            $result = $conn->query("SELECT * FROM faqs ORDER BY id DESC");
                            $count = 1;
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr data-question='".htmlspecialchars(strtolower($row['question']))."' data-answer='".htmlspecialchars(strtolower($row['answer']))."'>
                                            <td>{$count}</td>
                                            <td>{$row['question']}</td>
                                            <td>".nl2br(htmlspecialchars($row['answer']))."</td>
                                            <td class='action-buttons text-center'>
                                                <a href='update.php?id={$row['id']}' class='btn btn-sm btn-primary'>
                                                    <i class='bi bi-pencil'></i>
                                                </a>
                                                <button class='btn btn-sm btn-danger delete-faq' data-id='{$row['id']}'>
                                                    <i class='bi bi-trash'></i>
                                                </button>
                                            </td>
                                        </tr>";
                                    $count++;
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center py-4'>No FAQs found. Create your first FAQ!</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                    <div id="no-results" class="no-results">No matching FAQs found</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Delete FAQ functionality
    document.querySelectorAll('.delete-faq').forEach(button => {
        button.addEventListener('click', function() {
            const faqId = this.getAttribute('data-id');
            
            Swal.fire({
                title: 'Confirm Deletion',
                text: "Are you sure you want to delete this FAQ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                backdrop: `rgba(0,0,0,0.7)`
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`delete_faq.php?id=${faqId}`)
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'FAQ has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: '#0056b3'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
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

    // Search functionality
    document.getElementById('search-input').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#faq-table-body tr');
        let hasResults = false;
        
        rows.forEach(row => {
            const question = row.getAttribute('data-question');
            const answer = row.getAttribute('data-answer');
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                row.style.display = '';
                hasResults = true;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        const noResults = document.getElementById('no-results');
        if (!hasResults && searchTerm.length > 0) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
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