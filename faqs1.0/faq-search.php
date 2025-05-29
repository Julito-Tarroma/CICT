<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Search System | Catanduanes State University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="https://www.catsu.edu.ph/wp-content/uploads/2023/03/cropped-CatSU-logo-32x32.png" sizes="32x32">
</head>
<!-- In faq-search.php, replace the current style section with this: -->
<style>
    :root {
        --primary-color: #0056a4;
        --secondary-color: #f7941d;
        --accent-color: #8dc63f;
        --light-color: #e6f0fa;
        --dark-color: #003366;
        --text-color: #333;
        --white: #ffffff;
        --content-padding: 2.5rem;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        color: var(--text-color);
        padding-top: 80px;
        margin: 0;
        font-size: 1.1rem;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .catsu-header {
        background-color: var(--primary-color);
        color: var(--white);
        padding: 1rem var(--content-padding);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transform: translateY(-100%);
        animation: slideDown 0.6s ease 0.3s forwards;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }
        to {
            transform: translateY(0);
        }
    }
    
    .catsu-logo {
        height: 60px;
        margin-right: 15px;
        transform: scale(0.8);
        opacity: 0;
        animation: scaleIn 0.5s ease 0.5s forwards;
    }
    
    @keyframes scaleIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .catsu-title {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 0;
        color: var(--white);
        transform: translateX(-20px);
        opacity: 0;
        animation: slideIn 0.5s ease 0.6s forwards;
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(-20px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .catsu-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        color: var(--white);
        transform: translateX(-20px);
        opacity: 0;
        animation: slideIn 0.5s ease 0.7s forwards;
    }
    
    .main-container {
        width: 100%;
        margin: 20px 0;
        padding: 0;
    }
    
    .search-section, 
    .faq-results-container,
    .popular-faqs {
        background-color: var(--white);
        padding: 2.3rem var(--content-padding);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 15px;
        transform: translateY(20px);
        opacity: 0;
        animation: fadeInUp 0.6s ease 0.8s forwards;
    }
    
    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 12px;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
        font-size: 1.8rem;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 70px;
        height: 4px;
        background-color: var(--secondary-color);
        transition: all 0.3s;
    }
    
    .section-title:hover:after {
        width: 100px;
    }

    #search-btn {
        background-color: var(--primary-color);
        border: none;
        border-radius: 0 5px 5px 0;
        padding: 0 25px;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 1.1rem;
    }
    
    #search-btn:hover {
        background-color: var(--dark-color);
        transform: scale(1.02);
    }
    
    .faq-results-container {
        min-height: 180px;
    }
    
    .faq-item {
        border-bottom: 1px solid #eee;
        padding: 25px 0;
        cursor: pointer;
        transition: all 0.3s;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .faq-item:last-child {
        border-bottom: none;
    }
    
    .faq-item:hover {
        background-color: var(--light-color);
        transform: translateX(5px);
    }
    
    .faq-item h3 {
        color: var(--primary-color);
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .faq-item h3:after {
        content: '+';
        font-size: 2rem;
        color: var(--secondary-color);
        transition: all 0.3s;
    }
    
    .faq-item.active h3:after {
        content: '-';
        transform: rotate(180deg);
    }
    
    .faq-item p {
        display: none;
        margin-top: 20px;
        color: #555;
        line-height: 1.8;
        font-size: 1.2rem;
        padding-right: 20px;
    }
    
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
        transform: scale(0.95);
        opacity: 0;
        animation: cardAppear 0.5s ease forwards;
    }
    
    @keyframes cardAppear {
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }
    
    .card-header {
        background-color: var(--primary-color);
        color: var(--white);
        font-weight: 600;
        padding: 20px 30px;
        border-bottom: none;
        font-size: 1.4rem;
    }
    
    .card-body {
        padding: 30px;
        background-color: #f9f9f9;
        font-size: 1.2rem;
        line-height: 1.8;
    }
    
    .no-results {
        text-align: center;
        padding: 50px 0;
        color: #666;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .no-results i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .no-results h4 {
        font-size: 1.8rem;
        margin-bottom: 15px;
    }
    
    .no-results p {
        font-size: 1.3rem;
        margin-bottom: 10px;
        line-height: 1.8;
    }
    
    .back-btn {
        background-color: var(--primary-color);
        color: var(--white);
        padding: 15px 30px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
        font-weight: 500;
        font-size: 1.3rem;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
        display: block;
        width: fit-content;
        transform: translateX(-20px);
        opacity: 0;
        animation: slideIn 0.5s ease 0.9s forwards;
    }
    
    .back-btn:hover {
        background-color: var(--dark-color);
        color: var(--white);
        transform: translateX(-3px) scale(1.05);
    }
    
    .back-btn i {
        margin-right: 12px;
        font-size: 1.2rem;
    }
    
    .input-group {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    #search {
        font-size: 1.2rem;
        padding: 15px;
        height: auto;
        transition: all 0.3s;
    }
    
    #search:focus {
        box-shadow: 0 0 0 3px rgba(0, 86, 164, 0.2);
        border-color: var(--secondary-color);
    }
    
    .faq-list {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .text-end {
        width: 100%;
        max-width: 1400px;
        margin: 25px auto 0;
        padding: 0 var(--content-padding);
    }
    
    /* Staggered animations for FAQ items */
    .faq-item {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s;
    }
    
    .faq-item:nth-child(1) { animation: fadeInUp 0.5s ease 0.9s forwards; }
    .faq-item:nth-child(2) { animation: fadeInUp 0.5s ease 1.0s forwards; }
    .faq-item:nth-child(3) { animation: fadeInUp 0.5s ease 1.1s forwards; }
    .faq-item:nth-child(4) { animation: fadeInUp 0.5s ease 1.2s forwards; }
    .faq-item:nth-child(5) { animation: fadeInUp 0.5s ease 1.3s forwards; }
    .faq-item:nth-child(6) { animation: fadeInUp 0.5s ease 1.4s forwards; }
    
    @media (max-width: 768px) {
        :root {
            --content-padding: 1.8rem;
        }
        
        .catsu-title {
            font-size: 1.7rem;
        }
        
        .catsu-subtitle {
            font-size: 1rem;
        }
        
        .catsu-logo {
            height: 55px;
        }
        
        .main-container {
            margin: 15px 0;
        }
        
        .search-section, 
        .popular-faqs,
        .faq-results-container {
            padding: 1.8rem var(--content-padding);
            margin-bottom: 12px;
        }
        
        .section-title {
            font-size: 1.6rem;
            margin-bottom: 20px;
        }
        
        .faq-item {
            padding: 20px 0;
        }
        
        .faq-item h3 {
            font-size: 1.3rem;
        }
        
        .faq-item p {
            font-size: 1.1rem;
            margin-top: 15px;
        }
        
        .card-header {
            padding: 18px;
            font-size: 1.2rem;
        }
        
        .card-body {
            padding: 25px;
            font-size: 1.1rem;
        }
        
        .no-results {
            padding: 40px 0;
        }
        
        .no-results i {
            font-size: 3.5rem;
        }
        
        .no-results h4 {
            font-size: 1.5rem;
        }
        
        .no-results p {
            font-size: 1.1rem;
        }
        
        #search {
            font-size: 1.1rem;
            padding: 12px;
        }
        
        .back-btn {
            font-size: 1.2rem;
            padding: 12px 25px;
        }
        
        .text-end {
            margin: 20px auto 0;
        }
    }
</style>
<body>
<header class="catsu-header">
    <div class="container-fluid px-0">
        <div class="d-flex align-items-center ms-2">  <!-- Minimal left margin -->
            <img src="cats.png" alt="CatSU Logo" class="catsu-logo me-2">
            <div>
                <h1 class="catsu-title mb-0">College of Information and Communication Technology</h1>
                <div class="catsu-subtitle">Frequently Asked Questions System </div>
            </div>
        </div>
    </div>
</header>

    <div class="main-container">
        <!-- Search Section -->
        <section class="search-section">
            <h2 class="section-title">Search FAQs</h2>
            <div class="input-group mb-3">
                <input type="text" id="search" class="form-control" placeholder="Type your question here...">
                <button id="search-btn" class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </section>

        <!-- FAQ Results -->
        <section class="faq-results-container">
            <div id="faq-results">
                <div class="no-results">
                    <i class="far fa-comment-dots"></i>
                    <h4>Search our FAQ </h4>
                    <p>Type your question in the search box above to find answers</p>
                </div>
            </div>
        </section>

        <!-- Popular FAQs -->
        <section class="popular-faqs">
            <h2 class="section-title">Popular Questions</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <h3>What are the requirements for shifting courses?</h3>
                    <p>To shift courses at Catanduanes State University, you need to submit a formal request form to the Registrar's Office, provide your current academic records, and obtain approval from both your current and prospective department heads. Some programs may require a minimum GPA of 2.5, a personal interview, or completion of specific prerequisite courses. The process typically takes 2-3 weeks during regular academic periods.</p>
                </div>
                <div class="faq-item">
                    <h3>How do I transfer credits from another school?</h3>
                    <p>Transfer students must submit an official transcript of records (TOR) with a red ribbon from CHED, course descriptions/syllabi for all subjects to be credited, and a honorable dismissal from their previous school. The CatSU Registrar's Office will evaluate your credits, and only courses with equivalent subjects and passing grades (at least 2.0 or its equivalent) will be credited. Evaluation may take 3-4 weeks during peak periods.</p>
                </div>
                <div class="faq-item">
                    <h3>What scholarship programs are available?</h3>
                    <p>CatSU offers various scholarship programs including: (1) CHED Scholarships (2) DOST Scholarships (3) CatSU Academic Scholarships for students with GWA of 1.75 or better (4) CatSU Athletic Scholarships (5) Local Government Unit Scholarships. Requirements vary but typically include good moral certificate, registration form, and proof of financial need. Applications are accepted at the start of each semester.</p>
                </div>
                <div class="faq-item">
                    <h3>What is the process for withdrawing from a course?</h3>
                    <p>Students may withdraw from a course by submitting a Dropping Form signed by the instructor, department chair, and college dean before midterm examinations. A "W" mark will appear on your record. After midterms, withdrawal requires valid reasons (medical, family emergencies) with supporting documents. Refunds follow CatSU's refund policy schedule.</p>
                </div>
                <div class="faq-item">
                    <h3>How can I request official documents?</h3>
                    <p>Requests for TOR, diploma, certification, and other official documents can be made at the Registrar's Office. Bring a valid ID and complete the request form. Regular processing takes 5-7 working days (rush processing available for additional fee). Alumni may request documents online through the CatSU Alumni Portal.</p>
                </div>
                <div class="faq-item">
                    <h3>What are the graduation requirements?</h3>
                    <p>To graduate, students must: (1) Complete all academic requirements (2) Clear all financial and property obligations (3) Pass the Exit Assessment (4) Attend the graduation orientation (5) Submit required documents (clearance, thesis/dissertation copies). Additional requirements may apply for honors graduates (minimum residency, no failing grades).</p>
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="homepage.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Homepage
                </a>
            </div>
        </section>
    </div>

    <script>
    $(document).ready(function() {
        // Get search query from URL
        const urlParams = new URLSearchParams(window.location.search);
        const query = urlParams.get('query');
        
        // If there's a query, perform search automatically
        if (query) {
            $('#search').val(query);
            performSearch(query);
        }

        // FAQ toggle functionality for popular questions
        $('.faq-item').click(function() {
            $(this).toggleClass('active');
            $(this).find('p').slideToggle(200);
        });

        // Clear results when search box is emptied
        $('#search').on('input', function() {
            if ($(this).val().trim() === '') {
                $('#faq-results').html(`
                    <div class="no-results">
                        <i class="far fa-comment-dots"></i>
                        <h4>Search our FAQ database</h4>
                        <p>Type your question in the search box above to find answers</p>
                    </div>
                `);
            }
        });
        
        // Smooth transition for back button
        $('.back-btn').click(function(e) {
            e.preventDefault();
            $('body').css({
                'opacity': '0',
                'transform': 'translateY(20px)',
                'transition': 'all 0.5s ease'
            });
            setTimeout(function() {
                window.location.href = "homepage.php";
            }, 500);
        });
    });

    function performSearch(query) {
        if (query.length > 1) {
            $.ajax({
                url: "search.php",
                type: "GET",
                data: { query: query },
                beforeSend: function() {
                    $('#faq-results').html(`
                        <div class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Searching FAQs...</p>
                        </div>
                    `);
                },
                success: function(data) {
                    let resultHtml = "";
                    let faqs = JSON.parse(data);

                    if (faqs.length > 0) {
                        faqs.forEach((faq, index) => {
                            resultHtml += `
                            <div class="card" style="animation-delay: ${0.3 + (index * 0.1)}s">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    ${faq.question}
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">${faq.answer}</p>
                                </div>
                            </div>`;
                        });
                    } else {
                        resultHtml = `
                        <div class="no-results">
                            <i class="far fa-frown"></i>
                            <h4>No results found</h4>
                            <p>We couldn't find any FAQs matching "${query}"</p>
                            <p>Try different keywords or check our popular questions below</p>
                        </div>`;
                    }

                    $("#faq-results").html(resultHtml);
                },
                error: function() {
                    $("#faq-results").html(`
                        <div class="no-results">
                            <i class="fas fa-exclamation-triangle"></i>
                            <h4>Search Error</h4>
                            <p>Unable to complete your search. Please try again later.</p>
                        </div>
                    `);
                }
            });
        } else {
            $("#faq-results").html(`
                <div class="no-results">
                    <i class="far fa-comment-dots"></i>
                    <h4>Enter your search</h4>
                    <p>Please type at least 2 characters to search</p>
                </div>
            `);
        }
    }

    // Search button click handler
    $('#search-btn').click(function() {
        performSearch($('#search').val().trim());
    });

    // Enter key handler
    $('#search').keypress(function(e) {
        if (e.which === 13) {
            performSearch($(this).val().trim());
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>