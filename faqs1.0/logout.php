<?php
// Original code starts here
session_start();
session_unset();
session_destroy();

// Set 404 response before output
http_response_code(404);
header('Content-Type: text/html');
?>
<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
        }
        h1 {
            font-size: 50px;
            color: #333;
        }
        p {
            font-size: 20px;
            color: #666;
        }
        a {
            color: #0066cc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! The page you're looking for doesn't exist.</p>
        <p><a href="homepage.php">Go back to homepage</a></p>
    </div>
    <!-- Original JSON output would go here, but replaced with HTML -->
    <script>
        // If you still need the JSON response for AJAX calls
        let originalResponse = <?php echo json_encode(['success' => true]); ?>;
        console.log('Original response:', originalResponse);
    </script>
</body>
</html>
<?php
exit();
?>