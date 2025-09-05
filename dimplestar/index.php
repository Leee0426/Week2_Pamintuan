<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimple Star Transport</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <style>
        :root {
            --primary: #ECBD2F;
            --primary-dark: #D4A829;
            --secondary: #347e29ff;
            --light: #F8F9FA;
            --dark: #343A40;
            --gray: #6C757D;
            --light-gray: #e9ecef;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Header Styles */
        header {
            background: var(--secondary);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            height: 50px;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav li {
            margin: 0 5px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 15px;
        }
        
        nav a:hover, nav a.current {
            background: rgba(255,255,255,0.1);
            color: var(--primary);
        }
        
        .auth-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        
        .auth-button:hover {
            background-color: var(--primary-dark);
        }
        
        .auth-text {
            color: white;
            margin-right: 15px;
            font-weight: 500;
        }
        
        /* Hero Slider */
        .slider-container {
            margin: 30px auto;
            position: relative;
            max-width: 100%;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .slide {
            display: none;
            animation: fade 1.5s ease-in-out;
        }
        
        @keyframes fade {
            from {opacity: 0.4}
            to {opacity: 1}
        }
        
        .slide img {
            width: 100%;
            height: auto;
            vertical-align: middle;
        }
        
        .slider-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        
        .prev, .next {
            cursor: pointer;
            width: 50px;
            height: 50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.3s ease;
            border-radius: 50%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 15px;
        }
        
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
            transform: scale(1.1);
        }
        
        .dot-container {
            text-align: center;
            padding: 15px 0;
        }
        
        .dot {
            cursor: pointer;
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        
        .active, .dot:hover {
            background-color: var(--primary);
            transform: scale(1.2);
        }
        
        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }
        
        .feature-box {
            background: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .feature-box:hover {
            transform: translateY(-5px);
        }
        
        .feature-box i {
            font-size: 36px;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .feature-box h3 {
            color: var(--secondary);
            margin-bottom: 10px;
            font-size: 20px;
        }
        
        .feature-box p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Contact Section */
        .contact-section {
            background: var(--light);
            padding: 40px;
            border-radius: 8px;
            margin: 40px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .contact-section h2 {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .phone-number {
            font-size: 24px;
            color: var(--primary);
            margin: 15px 0;
            font-weight: bold;
        }
        
        .address {
            color: var(--gray);
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        /* Date Section */
        .date-section {
            background: var(--secondary);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 30px 0;
        }
        
        /* Footer */
        footer {
            background: var(--secondary);
            color: white;
            padding: 40px 0;
            text-align: center;
            margin-top: 50px;
        }
        
        .footer-logo {
            height: 50px;
            margin-bottom: 20px;
        }
        
        footer p {
            margin-top: 15px;
            color: rgba(255,255,255,0.7);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .header-content {
                flex-direction: column;
            }
            
            nav ul {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            nav li {
                margin: 5px;
            }
            
            .auth-container {
                margin-top: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .features {
                grid-template-columns: 1fr;
            }
            
            .prev, .next {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
            
            .contact-section {
                padding: 25px;
            }
        }
        
        .auth-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="index.php">
                    <img src="images/logo.png" class="logo" alt="Dimple Star Transport">
                </a>
                
                <nav>
                    <ul>
                        <li><a href="index.php" class="current">HOME</a></li>
                        <li><a href="about.php">ABOUT US</a></li>
                        <li><a href="terminal.php">TERMINALS</a></li>
                        <li><a href="routeschedule.php">ROUTES / SCHEDULES</a></li>
                        <li><a href="contact.php">CONTACT</a></li>
                        <li><a href="book.php">BOOK NOW</a></li>
                    </ul>
                </nav>
                
                <div class="auth-container">
                    <?php
                    
                        if(isset($_SESSION['email'])){
                            $email = $_SESSION['email'];
                            echo "<span class='auth-text'>Welcome, ". htmlspecialchars($email). "!</span>";
                            echo "<a href='logout.php' class='auth-button'>Logout</a>";
                        }
                        if(empty($email)){
                            echo "<a href='signlog.php' class='auth-button'>Sign Up / Login</a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <!-- Image Slider -->
        <div class="slider-container">
            <div class="slide">
                <img src="slide/images/b1.png" alt="Comfortable bus travel">
            </div>
            <div class="slide">
                <img src="slide/images/b2.png" alt="Modern bus fleet">
            </div>
            <div class="slide">
                <img src="slide/images/b3.png" alt="Travel destinations">
            </div>
            <div class="slide">
                <img src="slide/images/b4.png" alt="Affordable travel">
            </div>

            <div class="slider-controls">
                <div class="prev" onclick="plusSlides(-1)">&#10094;</div>
                <div class="next" onclick="plusSlides(1)">&#10095;</div>
            </div>
        </div>
        
        <div class="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
        </div>
        
        <!-- Features Section -->
        <div class="features">
            <div class="feature-box">
                <i class="fas fa-route"></i>
                <h3>Multiple Routes</h3>
                <p>Travel to various destinations across the region with our extensive network.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-ticket-alt"></i>
                <h3>Easy Booking</h3>
                <p>Book your tickets online in just a few clicks for a hassle-free experience.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-shield-alt"></i>
                <h3>Safe Travel</h3>
                <p>Your safety is our priority with modern vehicles and experienced drivers.</p>
            </div>
        </div>
        
        <!-- Contact Section -->
        <div class="contact-section">
            <h2>Contact Us</h2>
            <div class="phone-number">
                <i class="fas fa-phone-alt"></i> 0929 209 0712
            </div>
            <div class="address">
                <i class="fas fa-map-marker-alt"></i> Block 1 lot 10, Southpoint Subd.<br>
                Brgy Banay-Banay, Cabuyao, Laguna
            </div>
        </div>
        
        <!-- Date Section -->
        <div class="date-section">
            <h3><?php include_once("php_includes/date_time.php"); ?></h3>
        </div>
    </main>

    <footer>
        <div class="container">
            <a href="index.php">
                <img src="images/footer-logo.jpg" class="footer-logo" alt="Dimple Star Transport">
            </a>
            <p>&copy; <?php echo date("Y"); ?> Dimple Star Transport. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let slideIndex = 1;
            showSlides(slideIndex);

            window.plusSlides = function(n) {
                showSlides(slideIndex += n);
            }

            window.currentSlide = function(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                let slides = document.getElementsByClassName("slide");
                let dots = document.getElementsByClassName("dot");
                
                if (n > slides.length) {slideIndex = 1}
                if (n < 1) {slideIndex = slides.length}
                
                for (let i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (let i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                
                slides[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " active";
            }

            // Auto advance slides every 4 seconds
            setInterval(function() {
                plusSlides(1);
            }, 4000);
        });
    </script>
</body>
</html>