<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Dimple Star Transport</title>
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
        
        /* Main Content */
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
        
        /* About Content */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 768px) {
            .about-content {
                grid-template-columns: 1fr;
            }
        }
        
        .mission-vision {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .mission-vision-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .mission-vision-card:hover {
            transform: translateY(-5px);
        }
        
        .mission-vision-card h3 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 22px;
            display: flex;
            align-items: center;
        }
        
        .mission-vision-card h3 i {
            margin-right: 10px;
        }
        
        .mission-vision-card p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        .history-section {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }
        
        .history-section h3 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 22px;
            display: flex;
            align-items: center;
        }
        
        .history-section h3 i {
            margin-right: 10px;
        }
        
        .history-section p {
            color: var(--gray);
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .old-bus-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .social-share {
            display: flex;
            justify-content: center;
            margin-top: 20px;
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
                        <li><a href="about.php" class="current">About Us</a></li>
                        <li><a href="terminal.php">Terminals</a></li>
                        <li><a href="routeschedule.php">Routes / Schedules</a></li>
                        <li><a href="contact.php">Contact</a></li>
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
            <h1>ABOUT US</h1>
        </div>
        
        <div class="date-container">
            <h3><?php include_once("php_includes/date_time.php"); ?></h3>
        </div>
        
        <div class="about-content">
            <div>
                <img src="images/oldbus.jpg" alt="Historical bus photo from 1993" class="old-bus-image">
                
                <div class="social-share">
                    <?php include_once("php_includes/fblike.php"); ?>
                </div>
            </div>
            
            <div class="mission-vision">
                <div class="mission-vision-card">
                    <h3><i class="fas fa-bullseye"></i> Mission</h3>
                    <p>To provide superior transport service to Metro Manila and Mindoro Province commuters.</p>
                </div>
                
                <div class="mission-vision-card">
                    <h3><i class="fas fa-eye"></i> Vision</h3>
                    <p>To lead the bus transport industry through its innovation service to the riding public.</p>
                </div>
            </div>
        </div>
        
        <div class="history-section">
            <h3><i class="fas fa-history"></i> History</h3>
            <p>Photo taken on October 16, 1993. Napat Transit (now Dimple Star Transport) NVR-963
            (fleet No 800) going to Alabang and jeepneys under the Light Rail Line in Taft Ave near
            United Nations Avenue, Ermita, Manila, Philippines.</p>
            <p>Year 2004 of May changes has been made, Napat Transit became Dimple Star Transport.</p>
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