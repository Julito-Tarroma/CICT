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
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f9f9f9;
            line-height: 1.6;
        }

        :root {
            --primary-color: #003366;
            --secondary-color: #FFD700;
            --accent-color: #0056b3;
            --white-color: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #333333;
            --font-size-xxl: 4.5rem;
            --font-size-xl: 2rem;
            --font-size-lg: 1.5rem;
            --font-size-md: 1.2rem;
            --font-size-sm: 1rem;
            --font-weight-bold: 700;
            --font-weight-semibold: 600;
            --font-weight-normal: 400;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        /* Hero Section - Improved Version */
        .main-hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
            margin-top: 80px;
            background-color: var(--primary-color);
            background-image: linear-gradient(rgba(67, 93, 118, 0.8), rgba(0, 51, 102, 0.8)), url('catsus.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            color: var(--white-color);
        }

        .search-container {
            max-width: 800px;
            width: 90%;
            padding: 3rem 2rem;
        }

        .search-container h2 {
            color: var(--white-color);
            margin-bottom: 1.5rem;
            font-size: var(--font-size-xxl);
            font-weight: var(--font-weight-bold);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .search-container p {
            color: var(--white-color);
            margin-bottom: 2.5rem;
            font-size: var(--font-size-md);
            font-weight: var(--font-weight-semibold);
            opacity: 0.9;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .search-bar input {
            width: 70%;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 50px 0 0 50px;
            font-size: var(--font-size-md);
            background-color: rgba(255, 255, 255, 0.9);
            transition: var(--transition);
        }

        .search-bar input:focus {
            outline: none;
            background-color: var(--white-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.3);
        }

        .search-bar button {
            padding: 1rem 1.8rem;
            border: none;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border-radius: 0 50px 50px 0;
            cursor: pointer;
            font-size: var(--font-size-md);
            font-weight: var(--font-weight-bold);
            transition: var(--transition);
        }

        .search-bar button:hover {
            background-color: #ffcc00;
            transform: scale(1.02);
        }

        .scroll-down {
            margin-top: 3rem;
            color: var(--white-color);
            font-size: 2rem;
            animation: bounce 2s infinite;
            cursor: pointer;
            opacity: 0.8;
            transition: var(--transition);
        }

        .scroll-down:hover {
            opacity: 1;
            transform: translateY(5px);
        }

        /* Header */
        header {
            background-color: var(--primary-color);
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-logo img {
            height: 50px;
            width: auto;
            transition: var(--transition);
        }

        .header-logo:hover img {
            transform: scale(1.05);
        }

        /* Main Content Sections */
        main {
            padding: 4rem 2rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title h2 {
            color: var(--primary-color);
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-bold);
            display: inline-block;
            padding-bottom: 1rem;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background-color: var(--secondary-color);
            border-radius: 2px;
        }

        /* FAQ Categories */
        .faq-categories {
            margin: 5rem 0;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .category-card {
            background-color: var(--white-color);
            padding: 2.5rem 1.5rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: var(--box-shadow);
            cursor: pointer;
            transition: var(--transition);
            border-top: 5px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background-color: var(--secondary-color);
            transform: scaleX(0);
            transform-origin: left;
            transition: var(--transition);
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .category-card:hover i {
            color: var(--accent-color);
            transform: scale(1.1);
        }

        .category-card h3 {
            color: var(--primary-color);
            font-size: 1.4rem;
            font-weight: var(--font-weight-semibold);
            margin-bottom: 1rem;
        }

        .category-card a {
            text-decoration: none;
            color: inherit;
        }

        /* Popular FAQs */
        .popular-faqs {
            margin: 5rem 0;
        }

        .faq-list {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-item {
            background-color: var(--white-color);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: var(--box-shadow);
            border-left: 5px solid var(--primary-color);
            transition: var(--transition);
            cursor: pointer;
        }

        .faq-item:hover {
            border-left-color: var(--secondary-color);
            transform: translateX(5px);
        }

        .faq-item h3 {
            color: var(--primary-color);
            font-size: 1.3rem;
            font-weight: var(--font-weight-semibold);
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-item h3::after {
            content: '\f078';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 1rem;
            transition: var(--transition);
        }

        .faq-item.active h3::after {
            transform: rotate(180deg);
        }

        .faq-item p {
            display: none;
            color: var(--dark-gray);
            line-height: 1.7;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            animation: fadeIn 0.3s ease;
        }

        .faq-item.active p {
            display: block;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem;
            background-color: var(--primary-color);
            color: var(--white-color);
            font-size: var(--font-size-sm);
        }

        /* Admin Dropdown */
        .admin-dropdown {
            display: inline-block;
            position: relative;
        }

        .admin-btn {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: var(--font-weight-bold);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-btn:hover {
            background-color: #e6c200;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--white-color);
            min-width: 160px;
            box-shadow: var(--box-shadow);
            border-radius: 8px;
            right: 0;
            z-index: 1;
            overflow: hidden;
        }

        .dropdown-content a {
            color: var(--primary-color);
            padding: 0.8rem 1rem;
            display: block;
            text-decoration: none;
            transition: var(--transition);
            font-weight: var(--font-weight-semibold);
        }

        .dropdown-content a:hover {
            background-color: var(--light-gray);
            padding-left: 1.2rem;
        }

        .admin-dropdown:hover .dropdown-content {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        /* Floating Chat Button */
        .chat-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 70px;
            height: 70px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
            text-decoration: none;
            z-index: 1000;
            border: none;
        }

        .chat-button:hover {
            background-color: #ffcc00;
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .chat-button i {
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-15px); }
            60% { transform: translateY(-7px); }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .search-container h2 {
                font-size: 2rem;
            }
            
            .search-container p {
                font-size: 1rem;
            }
            
            .search-bar {
                flex-direction: column;
            }
            
            .search-bar input {
                width: 100%;
                border-radius: 50px;
                margin-bottom: 0.5rem;
            }
            
            .search-bar button {
                width: 100%;
                border-radius: 50px;
            }
            
            .category-grid {
                grid-template-columns: 1fr;
            }
        }
 /* Enhanced Header Navigation */
.header-nav {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-link {
    color: var(--white-color);
    text-decoration: none;
    font-weight: var(--font-weight-bold);
    font-size: var(--font-size-md);
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    transition: var(--transition);
    position: relative;
    background-color: transparent;
}

.nav-link:hover {
    background-color: rgba(255, 215, 0, 0.15);
    transform: translateY(-2px);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 3px;
    background-color: var(--secondary-color);
    transition: var(--transition);
    border-radius: 3px;
}

.nav-link:hover::after {
    width: 60%;
}

/* Active state for navigation */
.nav-link.active {
    color: var(--secondary-color);
}

.nav-link.active::after {
    width: 60%;
    background-color: var(--secondary-color);
}
    </style>
</head>
<body>
  <!-- Header Section with Logo and Admin -->
  <header>
    <div class="header-logo">
        <img src="catsu.png" alt="Catanduanes State University Logo">
    </div>
    <nav class="header-nav">
        <a href="#" class="nav-link home-link" onclick="smoothScrollToTop(event)">Home</a>
        <a href="#" class="nav-link explore-link" onclick="smoothScrollToExplore(event)">Explore</a>
        <div class="admin-dropdown">
            <button class="admin-btn">Admin <i class="fas fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="index.php">Log In</a>
            </div>
        </div>
    </nav>
</header>
    <!-- Hero Section with Search -->
    <div class="main-hero">
        <div class="search-container">
            <h2>FAQs on Shifting and Transferring in CICT</h2>
            <p>Your comprehensive guide to navigating CICT transfers and shifting requirements at Catanduanes State University</p>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search for FAQs..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                <button onclick="performSearch()"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>

        <div class="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <!-- Main Content Section -->
    <main id="main-content">
        <!-- FAQ Categories -->
        <section id="explore-categories" class="faq-categories">
    <div class="section-title">
        <h2>Explore Categories</h2>
    </div>
            <div class="category-grid">
                <div class="category-card">
                    <a href="shifting-process.php">
                        <i class="fas fa-user-graduate"></i>
                        <h3>Shifting Process</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="transfer-process.php">
                        <i class="fas fa-exchange-alt"></i>
                        <h3>Transfer Process</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="academic-requirements.php">
                        <i class="fas fa-book"></i>
                        <h3>Academic Requirements</h3>
                    </a>
                </div>
                <div class="category-card">
    <a href="aboutus.php">
        <i class="fas fa-info-circle"></i>
        <h3>About Us</h3>
    </a>
</div>

        </section>
   
        <section class="popular-faqs">
            <div class="section-title">
                <h2>Popular FAQs</h2>
            </div>
            <div class="faq-list">
                <div class="faq-item">
                    <h3>What are the requirements for shifting courses?</h3>
                    <p>To shift courses within CICT, you need to submit the following: a formal letter of request, your current academic records, a certificate of good moral character, and approval from both your current and prospective department heads. Some programs may require a minimum GPA of 2.5 and an interview with the department panel.</p>
                </div>
                <div class="faq-item">
                    <h3>How do I transfer credits from another school?</h3>
                    <p>For external transfers, you must submit official transcripts and course descriptions from your previous institution. The CICT department will evaluate each course for equivalency. Typically, only courses with at least a grade of 2.5 (or its equivalent) and matching 75% of our course content will be credited.</p>
                </div>
                <div class="faq-item">
                    <h3>Can I apply for a scholarship after transferring?</h3>
                    <p>Yes, transfer students can apply for most university scholarships after completing one semester at CSU with a GPA of at least 2.75. Some department-specific scholarships may have additional requirements. Visit the Scholarship Office or check our website for current opportunities.</p>
                </div>
                <div class="faq-item">
                    <h3>What is the deadline for shifting applications?</h3>
                    <p>Shifting applications are accepted during the midterm period (usually weeks 5-7 of the semester) and must be completed before final exams begin. Exact dates are published in the academic calendar each semester.</p>
                </div>
                <div class="faq-item">
                    <h3>How long does the transfer process take?</h3>
                    <p>The complete transfer evaluation process typically takes 2-3 weeks after submitting all required documents during the application period. We recommend applying early as some programs have limited slots for transferees.</p>
                </div>
                <div class="faq-item">
                    <h3>Are there orientation programs for new shifters/transferees?</h3>
                    <p>Yes! CICT conducts a special orientation at the start of each semester for all new shifters and transferees. This includes academic advising, campus tours, and meetings with student organizations. Attendance is mandatory.</p>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Floating Chat Button -->
    <a href="chatus.php" class="chat-button">
        <i class="fas fa-comments"></i>
    </a>
    
    <footer>
        <p>&copy; 2024 Catanduanes State University | College of Information and Communications Technology</p>
        <p>Contact: cict@catsu.edu.ph</p>
        <P> Programmer : Julito Tarroma | 091266015475 </p>
    </footer>

 <!-- In homepage.php, replace the current script section with this: -->
<script>
    function performSearch() {
        var searchQuery = document.getElementById('search-input').value.trim();
        if (searchQuery === "") {
            alert("Please enter a search term.");
            return;
        }
        
        // Add transition effect before redirecting
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';
        
        setTimeout(function() {
            window.location.href = "faq-search.php?query=" + encodeURIComponent(searchQuery);
        }, 500);
    }

    // Fade in effect when page loads
    document.addEventListener('DOMContentLoaded', function() {
        document.body.style.opacity = '0';
        setTimeout(function() {
            document.body.style.opacity = '1';
            document.body.style.transition = 'opacity 0.5s ease';
        }, 10);
    });

    // Rest of your existing JavaScript...
    document.getElementById('search-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    document.querySelectorAll('.faq-item').forEach(item => {
        const question = item.querySelector('h3');
        question.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });

    document.querySelector('.scroll-down').addEventListener('click', function() {
        document.querySelector('main').scrollIntoView({ 
            behavior: 'smooth' 
        });
    });

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

    function smoothScrollToTop(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        e.target.classList.add('active');
    }

    function smoothScrollToExplore(e) {
        e.preventDefault();
        const exploreSection = document.querySelector('.section-title h2');
        const headerOffset = 100;
        const elementPosition = exploreSection.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
        
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        e.target.classList.add('active');
    }

    window.addEventListener('scroll', function() {
        const exploreSection = document.querySelector('.section-title h2');
        const explorePosition = exploreSection.getBoundingClientRect().top;
        const scrollPosition = window.scrollY;
        const headerHeight = document.querySelector('header').offsetHeight;
        
        const homeLink = document.querySelector('.home-link');
        const exploreLink = document.querySelector('.explore-link');
        
        if (scrollPosition < headerHeight) {
            homeLink.classList.add('active');
            exploreLink.classList.remove('active');
        } else if (explorePosition <= headerHeight + 100) {
            homeLink.classList.remove('active');
            exploreLink.classList.add('active');
        } else {
            homeLink.classList.remove('active');
            exploreLink.classList.remove('active');
        }
    });
</script>
</body>
</html>