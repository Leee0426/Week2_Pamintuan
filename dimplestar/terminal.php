<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminals - Dimple Star Transport</title>
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
        
        /* Terminal Cards */
        .terminals-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .terminal-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .terminal-card:hover {
            transform: translateY(-5px);
        }
        
        .terminal-header {
            background: var(--primary);
            padding: 20px;
            color: white;
        }
        
        .terminal-header h3 {
            font-size: 22px;
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .terminal-header h3 i {
            margin-right: 10px;
        }
        
        .terminal-body {
            padding: 25px;
        }
        
        .contact-info {
            margin-bottom: 20px;
        }
        
        .contact-info p {
            color: var(--gray);
            margin: 5px 0;
            display: flex;
            align-items: center;
        }
        
        .contact-info i {
            color: var(--primary);
            margin-right: 10px;
            width: 20px;
        }
        
        .map-container {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 15px;
            height: 300px;
        }
        
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .map-link {
            text-align: right;
        }
        
        .map-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        
        .map-link a:hover {
            text-decoration: underline;
        }
        
        .map-link i {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }
        
        .map-link a:hover i {
            transform: translateX(3px);
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
        
        @media (max-width: 768px) {
            .terminal-body {
                padding: 20px;
            }
            
            .map-container {
                height: 250px;
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
                        <li><a href="terminal.php" class="current">Terminals</a></li>
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
            <h1>Our Terminals</h1>
        </div>
        
        <div class="date-container">
            <h3><?php include_once("php_includes/date_time.php"); ?></h3>
        </div>
        
        <div class="terminals-container">
            <!-- España Terminal -->
            <div class="terminal-card">
                <div class="terminal-header">
                    <h3><i class="fas fa-map-marker-alt"></i> España Terminal</h3>
                </div>
                <div class="terminal-body">
                    <div class="contact-info">
                        <p><i class="fas fa-phone"></i> <strong>Contact Numbers:</strong></p>
                        <p><i class="fas fa-circle-notch"></i> +63.02.985.1451</p>
                        <p><i class="fas fa-circle-notch"></i> +63.908.926.9163</p>
                    </div>
                    
                    <div class="map-container">
                        <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                            src="https://maps.google.com.ph/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Dimple+Star,+836BAntipoloStSampaloc,521,Manila,&amp;aq=0&amp;oq=Metro+Manila&amp;sll=14.6125312,120.9948033&amp;sspn=0.011772,0.021136&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Dimple+Star&amp;ll=14.6125312,120.9948033&amp;spn=0.011772,0.021136&amp;z=14&amp;output=embed">
                        </iframe>
                    </div>
                    
                    <div class="map-link">
                        <a href="https://www.google.com/maps/place/Dimple+Star/@14.6125312,120.9948033,770m/data=!3m2!1e3!4b1!4m2!3m1!1s0x3397b60300001d5d:0xd30645794daddf84?hl=en;z=14" target="_blank">
                            View Larger Map <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- San Jose Terminal -->
            <div class="terminal-card">
                <div class="terminal-header">
                    <h3><i class="fas fa-map-marker-alt"></i> San Jose Terminal</h3>
                </div>
                <div class="terminal-body">
                    <div class="contact-info">
                        <p><i class="fas fa-phone"></i> <strong>Contact Numbers:</strong></p>
                        <p><i class="fas fa-circle-notch"></i> +63.02.6684151</p>
                        <p><i class="fas fa-circle-notch"></i> +63.921.568.6449</p>
                    </div>
                    
                    <div class="map-container">
                        <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                            src="https://maps.google.com.ph/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Dimple+Star+Transport,+BonifacioSt,SanJose,OccidentalMindoro,&amp;aq=0&amp;oq=&amp;sll=12.3540632,121.0618653&amp;sspn=0.011772,0.021136&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Dimple+Star+Transport&amp;ll=12.3540632,121.0618653&amp;spn=0.011772,0.021136&amp;z=14&amp;output=embed">
                        </iframe>
                    </div>
                    
                    <div class="map-link">
                        <a href="https://www.google.com/maps/place/Dimple+Star+Transport/@14.6143711,120.9841972,458m/data=!3m2!1e3!4b1!4m2!3m1!1s0x3397b5fe6f7ebf6b:0xc34baa5ed38261eb?hl=en;z=14" target="_blank">
                            View Larger Map <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
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