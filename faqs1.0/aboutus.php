<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs for Shifting/Transferring | Catanduanes State University</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.8;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
            font-size: 18px;
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        body.loaded {
            opacity: 1;
        }

        /* Header with Animation */
        .header {
            background-color: #003366;
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100px;
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

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .header-title {
            font-size: 1.8rem;
            margin: 0;
            color: white;
            transition: all 0.3s ease;
        }

        /* Main Container with Animation */
        .container {
            width: 95%;
            max-width: none;
            margin: 30px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.6s ease;
        }

        .container.visible {
            transform: translateY(0);
            opacity: 1;
        }

        h1 {
            color: #003366;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2rem;
            position: relative;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #ffcc00;
            transition: width 0.3s ease;
        }

        h1:hover:after {
            width: 150px;
        }

        h2 {
            color: #d35400;
            border-bottom: 3px solid #003366;
            padding-bottom: 10px;
            font-size: 1.8rem;
            margin-top: 40px;
            grid-column: 1 / -1;
            transition: all 0.3s ease;
        }

        h2:hover {
            color: #003366;
            border-bottom-color: #ffcc00;
        }

        /* FAQ Items with Animation */
        .faq-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .faq-item {
            background: #f0f8ff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            min-height: 300px;
            display: flex;
            flex-direction: column;
            transition: all 0.4s ease;
            transform: scale(0.98);
            opacity: 0;
        }

        .faq-item.visible {
            transform: scale(1);
            opacity: 1;
        }

        .faq-item:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            background: #e1f0ff;
        }

        .faq-question {
            font-weight: bold;
            color: #003366;
            margin-bottom: 15px;
            font-size: 1.4em;
            transition: color 0.3s ease;
        }

        .faq-item:hover .faq-question {
            color: #d35400;
        }

        .faq-answer {
            padding-left: 10px;
            font-size: 1.1em;
            flex-grow: 1;
            transition: all 0.3s ease;
        }

        .faq-answer ul {
            padding-left: 20px;
        }

        .faq-answer li {
            margin-bottom: 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .faq-answer li:before {
            content: '•';
            color: #ffcc00;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
            transition: all 0.3s ease;
        }

        .faq-item:hover .faq-answer li:before {
            color: #d35400;
            transform: scale(1.3);
        }

        /* Important Note with Animation */
        .important-note {
            background-color: #fff8e1;
            padding: 25px;
            border-left: 6px solid #f5a425;
            margin: 30px 0;
            font-size: 1.2em;
            border-radius: 5px;
            grid-column: 1 / -1;
            transform: scale(0.98);
            opacity: 0;
            transition: all 0.5s ease;
        }

        .important-note.visible {
            transform: scale(1);
            opacity: 1;
        }

        .important-note:hover {
            border-left-color: #d35400;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Footer with Animation */
        .footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
            font-size: 1.1rem;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.6s ease;
        }

        .footer.visible {
            transform: translateY(0);
            opacity: 1;
        }

        /* Back button with Enhanced Animation */
        .back-button {
            display: inline-block;
            margin-top: 40px;
            padding: 15px 30px;
            color: #003366;
            background-color: #ffcc00;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.4s cubic-bezier(0.65, 0, 0.35, 1);
            border: none;
            font-size: 1.2em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            grid-column: 1 / -1;
            text-align: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .back-button:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #003366;
            transition: width 0.4s cubic-bezier(0.65, 0, 0.35, 1);
            z-index: -1;
        }

        .back-button:hover {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .back-button:hover:before {
            width: 100%;
        }

        .back-button i {
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .back-button:hover i {
            transform: translateX(-5px);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .faq-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                height: auto;
                padding: 20px;
                text-align: center;
            }

            .logo-container {
                justify-content: center;
                margin-bottom: 15px;
            }

            .container {
                width: 95%;
                padding: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .faq-question {
                font-size: 1.2em;
            }

            .faq-container {
                grid-template-columns: 1fr;
            }

            .faq-item {
                min-height: auto;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="cats.png" alt="CatSU Logo" class="logo">
            <h1 class="header-title">College of Information and Communication Technology</h1>
        </div>
    </div>

    <div class="container">
        <h1>Frequently Asked Questions for Shifting and Transferring Students</h1>

        <div class="important-note">
            <p><strong>Note:</strong> The following information serves as general guidelines. For specific concerns, please contact the Registrar's Office or your prospective department.</p>
        </div>

        <div class="faq-container">
            <h2>General Requirements</h2>

            <div class="faq-item">
                <div class="faq-question">1. What are the basic requirements for shifting to another program?</div>
                <div class="faq-answer">
                    <p>To shift programs within CatSU, you must:</p>
                    <ul>
                        <li>Have completed at least one academic year in your current program</li>
                        <li>Have no failing grades in your current program</li>
                        <li>Meet the GPA requirement of the target program (usually 2.5 or higher)</li>
                        <li>Submit a formal letter of request addressed to the Dean of the target college</li>
                        <li>Complete the shifting form from the Registrar's Office</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">2. What documents are needed for transferring from another school?</div>
                <div class="faq-answer">
                    <p>Transfer students need to submit:</p>
                    <ul>
                        <li>Official Transcript of Records (TOR)</li>
                        <li>Honorable Dismissal/Certificate of Transfer Credentials</li>
                        <li>Course Description/s for credit evaluation</li>
                        <li>2x2 ID pictures (2 copies)</li>
                        <li>Birth Certificate (PSA copy)</li>
                        <li>Good Moral Certificate</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">3. When is the best time to apply for shifting?</div>
                <div class="faq-answer">
                    <p>The shifting application period is typically:</p>
                    <ul>
                        <li>Midterm of the current semester (for evaluation)</li>
                        <li>Final examination week (for submission of requirements)</li>
                        <li>Before enrollment for the next semester (for approval)</li>
                    </ul>
                    <p>Specific dates are announced each semester through official university channels.</p>
                </div>
            </div>

            <h2>Process and Timeline</h2>

            <div class="faq-item">
                <div class="faq-question">4. How long does the evaluation process take?</div>
                <div class="faq-answer">
                    <p>The evaluation process usually takes 2-3 weeks after submission of complete requirements. This includes:</p>
                    <ul>
                        <li>Department evaluation of academic records</li>
                        <li>Interview (for some programs)</li>
                        <li>Approval from both current and receiving departments</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">5. Will all my completed courses be credited?</div>
                <div class="faq-answer">
                    <p>Credit evaluation depends on:</p>
                    <ul>
                        <li>Course equivalency between programs</li>
                        <li>Grade requirements (some programs require minimum grades for credited courses)</li>
                        <li>Curriculum alignment (GE courses are more likely to be credited than major subjects)</li>
                    </ul>
                    <p>The receiving department will evaluate which courses can be credited to your new program.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">6. Will shifting or transferring affect my graduation timeline?</div>
                <div class="faq-answer">
                    <p>This depends on several factors:</p>
                    <ul>
                        <li>How many courses can be credited from your previous program</li>
                        <li>Curriculum differences between programs</li>
                        <li>Availability of courses each semester</li>
                    </ul>
                    <p>Most shifting/transferring students experience some extension of their study period, typically 1-2 semesters.</p>
                </div>
            </div>

            <h2>Other Concerns</h2>

            <div class="faq-item">
                <div class="faq-question">7. Are there programs with special shifting requirements?</div>
                <div class="faq-answer">
                    <p>Yes, some competitive programs have additional requirements:</p>
                    <ul>
                        <li>Entrance examinations (for programs like Nursing, Engineering)</li>
                        <li>Portfolio review (for Fine Arts, Architecture)</li>
                        <li>Higher GPA requirements (typically 2.75 or 3.0)</li>
                        <li>Interview with department chair</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">8. Where can I get more information?</div>
                <div class="faq-answer">
                    <p>For specific concerns, you may contact:</p>
                    <ul>
                        <li><strong>Registrar's Office:</strong> (052) 811-1111 local 123</li>
                        <li><strong>Admissions Office:</strong> admissions@catsu.edu.ph</li>
                        <li><strong>Your current Department Chair</strong></li>
                        <li><strong>Target Department's Secretary</strong></li>
                    </ul>
                    <p>Office hours are Monday-Friday, 8:00 AM to 5:00 PM.</p>
                </div>
            </div>
            <a class="back-button" href="homepage.php#main-content"><i class="fas fa-arrow-left"></i> Back to Categories</a>
        </div>
    </div>

    <div class="footer">
   
    <p>&copy; 2024 Catanduanes State University | College of Information and Communications Technology</p>
        <p>Contact: cict@catsu.edu.ph</p>
        <P> Programmer : Julito Tarroma | 091266015475 </p>
   
    </div>

    <script>
    // Page load animation
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('loaded');
        
        // Intersection Observer for scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    
                    // Animate FAQ items sequentially if it's the container
                    if (entry.target.classList.contains('faq-container')) {
                        const items = entry.target.querySelectorAll('.faq-item');
                        items.forEach((item, index) => {
                            setTimeout(() => {
                                item.classList.add('visible');
                            }, index * 100);
                        });
                    }
                }
            });
        }, { threshold: 0.1 });

        // Observe elements
        document.querySelectorAll('.container, .important-note, .faq-container, .footer').forEach(el => {
            observer.observe(el);
        });
    });
    </script>
</body>
</html>