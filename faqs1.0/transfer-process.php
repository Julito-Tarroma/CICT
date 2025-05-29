<?php
include("connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Homepage - CICT Shifting and Transferring</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f9f9f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        body.loaded {
            opacity: 1;
        }

        /* Header with Animations */
        header {
            background: linear-gradient(135deg, #0056b3, #003366);
            color: #fff;
            padding: 60px 20px 40px;
            text-align: center;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-20px);
            opacity: 0;
            animation: slideDown 0.8s ease forwards 0.3s;
        }

        @keyframes slideDown {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Main Content Animations */
        .process-section {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            text-align: left;
            border-top: 5px solid #ffcc00;
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.6s ease;
        }

        .process-section.visible {
            transform: translateY(0);
            opacity: 1;
        }

        /* Footer Animation */
        footer {
            text-align: center;
            padding: 25px 20px;
            background: #003366;
            color: #fff;
            margin-top: auto;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.6s ease 0.2s;
        }

        footer.visible {
            transform: translateY(0);
            opacity: 1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f9f9f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header with CSU-style blue gradient */
        header {
            background: linear-gradient(135deg, #0056b3, #003366);
            color: #fff;
            padding: 60px 20px 40px;
            text-align: center;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-content h1 {
            font-size: 2.8em;
            margin-bottom: 15px;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .header-content p {
            font-size: 1.3em;
            margin: 10px 0 30px;
            opacity: 0.9;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            max-width: 700px;
            margin: 0 auto;
        }

        .search-bar input {
            width: 80%;
            padding: 12px 20px;
            border-radius: 30px 0 0 30px;
            border: none;
            font-size: 1.1em;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .search-bar button {
            padding: 12px 20px;
            border: none;
            background: #ffcc00; /* CSU gold accent */
            color: #003366;
            border-radius: 0 30px 30px 0;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .search-bar button:hover {
            background: #e6b800;
        }

        main {
            flex: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* Shifting Process Section with CSU colors */
        .process-section {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            text-align: left;
            border-top: 5px solid #ffcc00;
        }

        .process-section h2 {
            color: #003366;
            text-align: center;
            font-size: 2em;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .process-section h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #ffcc00;
        }

        .process-section p {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
        }

        .process-section ul {
            padding-left: 30px;
            margin: 25px 0;
        }

        .process-section li {
            margin: 15px 0;
            font-size: 1.1em;
            line-height: 1.5;
            position: relative;
            list-style-type: none;
            padding-left: 30px;
        }

        .process-section li:before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            width: 12px;
            height: 12px;
            background-color: #ffcc00;
            border-radius: 50%;
        }

        .process-section strong {
            color: #0056b3;
        }

        /* Back button with CSU colors */
        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            color: #003366;
            background-color: #ffcc00;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            font-size: 1em;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .back-button:hover {
            background-color: #e6b800;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        /* Footer with CSU dark blue */
        footer {
            text-align: center;
            padding: 25px 20px;
            background: #003366;
            color: #fff;
            margin-top: auto;
        }

        footer p {
            font-size: 1em;
            opacity: 0.9;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-content h1 {
                font-size: 2.2em;
            }
            
            .header-content p {
                font-size: 1.1em;
            }
            
            .process-section {
                padding: 30px 20px;
            }
            
            .search-bar input,
            .search-bar button {
                padding: 10px 15px;
            }
        }

        @media (max-width: 480px) {
            .header-content h1 {
                font-size: 1.8em;
            }
            
            .process-section h2 {
                font-size: 1.5em;
            }
            
            .process-section li {
                font-size: 1em;
            }
        }

        /* New Animation Styles */
        @keyframes ripple {
            0% { transform: scale(0); opacity: 0.5; }
            100% { transform: scale(20); opacity: 0; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        /* Enhanced Interactive Elements */
        .search-bar button:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        .process-section li {
            transition: all 0.3s ease;
        }

        .process-section li:hover {
            transform: translateX(10px);
        }

        .back-button {
            transition: all 0.4s cubic-bezier(0.65, 0, 0.35, 1);
        }

        .back-button:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="header-content">
            <h1>FAQs for Shifting and Transferring in CICT</h1>
            <p>Your guide to navigating CICT transfers and shifting requirements at Catanduanes State University</p>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search for FAQs..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                <button onclick="performSearch()"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
    </header>
   

    <main>
    <section id="transfer-process" class="process-section">
        <h2>Transfer Process Information</h2>
        <p>This section outlines the process for transferring from another institution to the College of Information and Communications Technology (CICT) at Catanduanes State University.</p>
        <ul>
            <li><strong>Step 1:</strong> Write a formal letter of intent addressed to the Dean of CICT stating your purpose for transferring.</li>
            <li><strong>Step 2:</strong> Secure and fill out a <strong>Transferee Application Form</strong> at the Registrar's Office.</li>
            <li><strong>Step 3:</strong> Submit the following documents:
                <ul>
                    <li>Original and photocopy of Honorable Dismissal</li>
                    <li>Original and photocopy of Transcript of Records (TOR) or Certified Copy of Grades</li>
                    <li>Certificate of Good Moral Character</li>
                    <li>2x2 ID photo (recent)</li>
                    <li>Photocopy of PSA/NSO Birth Certificate</li>
                </ul>
            </li>
            <li><strong>Step 4:</strong> Undergo screening and evaluation by the CICT Dean or Program Chair to assess course equivalency and academic eligibility.</li>
            <li><strong>Step 5:</strong> Attend an interview and orientation session (if required by the department).</li>
            <li><strong>Step 6:</strong> Wait for the evaluation result. Once approved, you will be allowed to proceed with enrollment under the CICT program.</li>
            <li><strong>Step 7:</strong> Submit all approved documents to the Registrar’s Office and complete your enrollment process (including ID validation and class registration).</li>
        </ul>
        <p><strong>Note:</strong> Only students with at least one semester of valid academic standing and no major disciplinary record are eligible to transfer to CatSU. The university has the right to deny applications based on program quotas and academic performance.</p>
        <a class="back-button" href="homepage.php#main-content"><i class="fas fa-arrow-left"></i> Back to Categories</a>
    </section>
</main>


    <!-- Footer Section -->
    <footer>
    <p>&copy; 2024 Catanduanes State University | College of Information and Communications Technology</p>
        <p>Contact: cict@catsu.edu.ph</p>
        <P> Programmer : Julito Tarroma | 091266015475 </p>
    </footer>

    <script>
    // Page load animation
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('loaded');
        
        // Intersection Observer for scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.process-section, footer').forEach(el => {
            observer.observe(el);
        });
    });

    function performSearch() {
        var searchQuery = document.getElementById('search-input').value.trim();
        if (searchQuery === "") {
            const searchBar = document.querySelector('.search-bar');
            searchBar.style.animation = 'shake 0.5s';
            searchBar.addEventListener('animationend', () => {
                searchBar.style.animation = '';
            });
            return;
        }
        window.location.href = "faq-search.php?query=" + encodeURIComponent(searchQuery);
    }

    // Allow search on Enter key
    document.getElementById('search-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });


 
    function performSearch() {
        var searchQuery = document.getElementById('search-input').value.trim();
        if (searchQuery === "") {
            alert("Please enter a search term.");
            return;
        }
        window.location.href = "faq-search.php?query=" + encodeURIComponent(searchQuery);
    }

    // Allow search on Enter key
    document.getElementById('search-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    // Improved FAQ toggle functionality
    document.querySelectorAll('.faq-item').forEach(item => {
        const question = item.querySelector('h3');
        question.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });

    // Smooth scroll to main content
    document.querySelector('.scroll-down').addEventListener('click', function() {
        document.querySelector('main').scrollIntoView({ 
            behavior: 'smooth' 
        });
    });

    // Add scroll animation for header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.1)';
            header.style.padding = '0.8rem 2rem';
        } else {
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.2)';
            header.style.padding = '1rem 2rem';
        }
    });
    </script>
</body>
</html>
