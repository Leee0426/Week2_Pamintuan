<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Dimple Star Transport</title>
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
        
        /* Page Header */
        .page-header {
            text-align: center;
            margin: 40px 0;
        }
        
        .page-header h1 {
            color: var(--secondary);
            font-size: 36px;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .page-header h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        
        /* Contact Content */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .contact-info-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            height: fit-content;
        }
        
        .contact-info-card h2 {
            color: var(--secondary);
            margin-bottom: 25px;
            font-size: 24px;
            display: flex;
            align-items: center;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 15px;
        }
        
        .contact-info-card h2 i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .contact-detail {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        
        .contact-icon {
            color: var(--primary);
            font-size: 20px;
            margin-right: 15px;
            min-width: 20px;
            margin-top: 3px;
        }
        
        .contact-text {
            color: var(--gray);
            line-height: 1.6;
        }
        
        .contact-text strong {
            color: var(--secondary);
            display: block;
            margin-bottom: 5px;
        }
        
        .contact-form-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }
        
        .contact-form-card h2 {
            color: var(--secondary);
            margin-bottom: 25px;
            font-size: 24px;
            display: flex;
            align-items: center;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 15px;
        }
        
        .contact-form-card h2 i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            color: var(--secondary);
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(236, 189, 47, 0.1);
        }
        
        .submit-btn {
            background: var(--primary);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .submit-btn:hover {
            background: var(--primary-dark);
        }
        
        .submit-btn i {
            margin-left: 8px;
        }
        
        /* Date and Auth Styles */
        .auth-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin: 20px 0;
        }
        
        .date-container {
            background: var(--secondary);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
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
        
        @media (max-width: 576px) {
            .contact-info-card,
            .contact-form-card {
                padding: 20px;
            }
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="terminal.php">Terminals</a></li>
                        <li><a href="routeschedule.php">Routes / Schedules</a></li>
                        <li><a href="contact.php" class="current">Contact</a></li>
                        <li><a href="book.php">Book Now</a></li>
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
        <div class="page-header">
            <h1>Get in Touch</h1>
        </div>
        
        <div class="date-container">
            <h3><?php include_once("php_includes/date_time.php"); ?></h3>
        </div>
        
        <div class="contact-grid">
            <div class="contact-info-card">
                <h2><i class="fas fa-info-circle"></i> Contact Information</h2>
                
                <div class="contact-detail">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-text">
                        <strong>Address</strong>
                        Block 1 lot 10, Southpoint Subd.<br>
                        Brgy Banay-Banay, Cabuyao, Laguna
                    </div>
                </div>
                
                <div class="contact-detail">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact-text">
                        <strong>Phone Number</strong>
                        0929 209 0712
                    </div>
                </div>
                
                <div class="contact-detail">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-text">
                        <strong>Operating Hours</strong>
                        24/7
                    </div>
                </div>
                
                <div class="contact-detail">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-text">
                        <strong>Email</strong>
                        info@dimplestar.com
                    </div>
                </div>
            </div>
            
            <div class="contact-form-card">
                <h2><i class="fas fa-paper-plane"></i> Send us a Message</h2>
                
                <form class="validate" action="messageexec.php" method="POST">
                    <div class="form-group">
                        <label for="name" class="required">Name</label>
                        <input id="name" type="text" name="name" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input id="email" type="email" name="email" placeholder="example@email.com" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="subject" class="required">Subject</label>
                        <input id="subject" type="text" name="subject" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="required">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="submit-btn" name="Submit">
                            Send Message <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
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
</body>
</html>