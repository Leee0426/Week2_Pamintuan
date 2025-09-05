<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes & Schedules - Dimple Star Transport</title>
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
        
        /* Route Map */
        .route-map {
            margin-bottom: 40px;
            text-align: center;
        }
        
        .route-map img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .route-note {
            color: var(--gray);
            font-style: italic;
            margin-top: 10px;
            text-align: center;
        }
        
        /* Schedule Table */
        .schedule-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }
        
        .schedule-header {
            background: var(--primary);
            padding: 20px;
            color: white;
        }
        
        .schedule-header h2 {
            font-size: 22px;
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .schedule-header h2 i {
            margin-right: 10px;
        }
        
        .schedule-body {
            padding: 25px;
            overflow-x: auto;
        }
        
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .schedule-table th {
            background-color: var(--light);
            color: var(--secondary);
            font-weight: 600;
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid var(--primary);
        }
        
        .schedule-table td {
            padding: 15px;
            border-bottom: 1px solid var(--light-gray);
            vertical-align: top;
        }
        
        .schedule-table tr:last-child td {
            border-bottom: none;
        }
        
        .schedule-table tr:hover {
            background-color: #f9f9f9;
        }
        
        .terminal-name {
            color: var(--secondary);
            font-weight: 600;
            min-width: 150px;
        }
        
        .time-slots {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .time-slot {
            background: var(--light);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            color: var(--dark);
            transition: all 0.2s ease;
        }
        
        .time-slot:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .destination {
            color: var(--secondary);
            font-weight: 500;
            min-width: 100px;
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
            .schedule-body {
                padding: 15px;
            }
            
            .schedule-table th, 
            .schedule-table td {
                padding: 10px;
            }
            
            .time-slots {
                gap: 6px;
            }
            
            .time-slot {
                padding: 4px 10px;
                font-size: 12px;
            }
        }
        
        @media (max-width: 576px) {
            .schedule-table {
                display: block;
            }
            
            .schedule-table thead {
                display: none;
            }
            
            .schedule-table tbody, 
            .schedule-table tr, 
            .schedule-table td {
                display: block;
                width: 100%;
            }
            
            .schedule-table tr {
                margin-bottom: 15px;
                border: 1px solid var(--light-gray);
                border-radius: 8px;
                padding: 10px;
            }
            
            .schedule-table td {
                border: none;
                padding: 8px;
            }
            
            .terminal-name::before {
                content: "Terminal: ";
                font-weight: bold;
                color: var(--secondary);
            }
            
            .destination::before {
                content: "Destination: ";
                font-weight: bold;
                color: var(--secondary);
            }
            
            .time-slots::before {
                content: "Schedule: ";
                font-weight: bold;
                color: var(--secondary);
                display: block;
                margin-bottom: 5px;
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
                        <li><a href="routeschedule.php" class="current">Routes / Schedules</a></li>
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
            <h1>Routes & Schedules</h1>
        </div>
        
        <div class="date-container">
            <h3><?php include_once("php_includes/date_time.php"); ?></h3>
        </div>
        
        <div class="route-map">
            <img src="images/route.png" alt="Dimple Star Transport Route Map">
            <p class="route-note">(All trips are vice versa)</p>
        </div>
        
        <div class="schedule-card">
            <div class="schedule-header">
                <h2><i class="fas fa-calendar-alt"></i> Regular Schedule</h2>
            </div>
            
            <div class="schedule-body">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Origin</th>
                            <th>Schedule</th>
                            <th>Destination</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="terminal-name">Ali Mall Cubao Terminal</td>
                            <td>
                                <div class="time-slots">
                                    <span class="time-slot">9:00 am</span>
                                    <span class="time-slot">10:00 am</span>
                                    <span class="time-slot">1:00 pm</span>
                                    <span class="time-slot">4:00 pm</span>
                                </div>
                            </td>
                            <td class="destination">San Jose</td>
                        </tr>
                        <tr>
                            <td class="terminal-name">Alabang Terminal</td>
                            <td>
                                <div class="time-slots">
                                    <span class="time-slot">6:00 am</span>
                                    <span class="time-slot">7:00 am</span>
                                    <span class="time-slot">2:00 pm</span>
                                    <span class="time-slot">6:00 pm</span>
                                    <span class="time-slot">10:00 pm</span>
                                </div>
                            </td>
                            <td class="destination">San Jose</td>
                        </tr>
                        <tr>
                            <td class="terminal-name">Cabuyao Terminal</td>
                            <td>
                                <div class="time-slots">
                                    <span class="time-slot">8:00 am</span>
                                    <span class="time-slot">9:00 am</span>
                                    <span class="time-slot">4:00 pm</span>
                                    <span class="time-slot">8:00 pm</span>
                                </div>
                            </td>
                            <td class="destination">San Jose</td>
                        </tr>
                        <tr>
                            <td class="terminal-name">España Terminal</td>
                            <td>
                                <div class="time-slots">
                                    <span class="time-slot">4:30 am</span>
                                    <span class="time-slot">5:30 am</span>
                                    <span class="time-slot">12:00 am</span>
                                    <span class="time-slot">4:00 pm</span>
                                    <span class="time-slot">8:00 pm</span>
                                </div>
                            </td>
                            <td class="destination">San Jose</td>
                        </tr>
                        <tr>
                            <td class="terminal-name">San Lazaro Terminal</td>
                            <td>
                                <div class="time-slots">
                                    <span class="time-slot">3:00 am</span>
                                    <span class="time-slot">4:30 am</span>
                                    <span class="time-slot">11:00 am</span>
                                    <span class="time-slot">3:00 pm</span>
                                    <span class="time-slot">7:00 pm</span>
                                </div>
                            </td>
                            <td class="destination">San Jose</td>
                        </tr>
                        <tr>
                            <td class="terminal-name">Pasay Terminal</td>
                            <td>
                                <div class="time-slots">
                                    <span class="time-slot">5:00 am</span>
                                    <span class="time-slot">6:00 am</span>
                                    <span class="time-slot">1:00 pm</span>
                                    <span class="time-slot">3:00 pm</span>
                                </div>
                            </td>
                            <td class="destination">San Jose</td>
                        </tr>
                    </tbody>
                </table>
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