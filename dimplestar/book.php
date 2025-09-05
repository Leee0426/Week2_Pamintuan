<!DOCTYPE html>
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
    
    // Check if includes exist before including them
    $connection_file = 'php_includes/connection.php';
    $book_file = 'php_includes/book.php';
    
    if (file_exists($connection_file)) {
        include $connection_file;
    } else {
        die("Error: Database connection file not found!");
    }
    
    if (file_exists($book_file)) {
        include $book_file;
    } else {
        // Continue without book.php if it doesn't exist
        error_log("Book.php include file not found");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - Dimple Star Transport</title>
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
            margin: 40px 0 30px;
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
        
        /* Booking Form */
        .booking-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            padding: 30px;
            margin-bottom: 40px;
        }
        
        .date-container {
            background: var(--secondary);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .form-section {
            margin-bottom: 25px;
        }
        
        .form-section-title {
            color: var(--secondary);
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
        }
        
        .form-section-title i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            color: var(--secondary);
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group select,
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .form-group select:focus,
        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(236, 189, 47, 0.1);
        }
        
        .radio-group {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
        }
        
        .radio-option input[type="radio"] {
            margin-right: 8px;
        }
        
        .radio-option span {
            color: var(--dark);
        }
        
        .date-input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 576px) {
            .date-input-group {
                grid-template-columns: 1fr;
            }
        }
        
        .submit-btn {
            background: var(--primary);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
            margin-top: 20px;
        }
        
        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .submit-btn i {
            margin-left: 8px;
        }
        
        /* Error Messages */
        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .success-message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
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
            .booking-card {
                padding: 20px;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 10px;
            }
        }
        
        .form-note {
            color: var(--gray);
            font-size: 14px;
            margin-top: 5px;
            font-style: italic;
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
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="book.php" class="current">Book Now</a></li>
                    </ul>
                </nav>
                
                <div class="auth-container">
    <?php
        if(isset($_SESSION['email'])){
            // Get the database connection
            $con = mysqli_connect("localhost", "root", "", "users_db");
            
            if ($con) {
                // Fetch user's first name from database
                $email = $_SESSION['email'];
                $query = "SELECT fname FROM members WHERE email = '$email'";
                $result = mysqli_query($con, $query);
                
                if($result && mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                    $first_name = htmlspecialchars($user['fname']);
                    echo "<span class='auth-text'>Welcome, $first_name!</span>";
                } else {
                    echo "<span class='auth-text'>Welcome!</span>";
                }
                
                mysqli_close($con);
            } else {
                echo "<span class='auth-text'>Welcome!</span>";
            }
            
            echo "<a href='logout.php' class='auth-button'>Logout</a>";
        } else {
            echo "<a href='signlog.php' class='auth-button'>Sign Up / Login</a>";
        }
    ?>
</div>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="page-header">
            <h1>Book Your Trip</h1>
        </div>
        
        <div class="date-container">
            <h3>
                <?php 
                    $date_time_file = 'php_includes/date_time.php';
                    if (file_exists($date_time_file)) {
                        include_once($date_time_file);
                    } else {
                        echo date('l m-d-Y');
                    }
                ?>
            </h3>
        </div>
        
        <!-- Display any error or success messages -->
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        
        if (isset($_SESSION['success_message'])) {
            echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>
        
        <div class="booking-card">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-grid">
                    <!-- Trip Type -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-route"></i> Trip Type
                        </div>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="one-way" name="way" value="1" checked 
                                       onclick="document.getElementById('datepick2').disabled=true">
                                <label for="one-way"><span>One Way</span></label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="two-way" name="way" value="2"
                                       onclick="document.getElementById('datepick2').disabled=false">
                                <label for="two-way"><span>Round Trip</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Route Information -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-map-marker-alt"></i> Route Information
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="Origin">Origin</label>
                                <select id="Origin" name="Origin" required>
                                    <option value="0">Select Origin</option>
                                    <option value="San Lazaro">San Lazaro</option>
                                    <option value="Espana">Espana</option>
                                    <option value="Alabang">Alabang</option>
                                    <option value="Cabuyao">Cabuyao</option>
                                    <option value="Naujan">Naujan</option>
                                    <option value="Victoria">Victoria</option>
                                    <option value="Pinamalayan">Pinamalayan</option>
                                    <option value="Gloria">Gloria</option>
                                    <option value="Bongabong">Bongabong</option>
                                    <option value="Roxas">Roxas</option>
                                    <option value="Mansalay">Mansalay</option>
                                    <option value="Bulalacao">Bulalacao</option>
                                    <option value="Magsaysay">Magsaysay</option>
                                    <option value="San Jose">San Jose</option>
                                    <option value="Pola">Pola</option>
                                    <option value="Soccoro">Soccoro</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="Destination">Destination</label>
                                <select id="Destination" name="Destination" required>
                                    <option value="0">Select Destination</option>
                                    <option value="San Lazaro">San Lazaro</option>
                                    <option value="Espana">Espana</option>
                                    <option value="Alabang">Alabang</option>
                                    <option value="Cabuyao">Cabuyao</option>
                                    <option value="Naujan">Naujan</option>
                                    <option value="Victoria">Victoria</option>
                                    <option value="Pinamalayan">Pinamalayan</option>
                                    <option value="Gloria">Gloria</option>
                                    <option value="Bongabong">Bongabong</option>
                                    <option value="Roxas">Roxas</option>
                                    <option value="Mansalay">Mansalay</option>
                                    <option value="Bulalacao">Bulalacao</option>
                                    <option value="Magsaysay">Magsaysay</option>
                                    <option value="San Jose">San Jose</option>
                                    <option value="Pola">Pola</option>
                                    <option value="Soccoro">Soccoro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Passenger Information -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-users"></i> Passenger Information
                        </div>
                        <div class="form-group">
                            <label for="no_of_pass">Number of Passengers</label>
                            <input type="number" id="no_of_pass" name="no_of_pass" min="1" max="10" required />
                            <p class="form-note">Maximum 10 passengers per booking</p>
                        </div>
                    </div>
                    
                    <!-- Travel Dates -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-calendar-alt"></i> Travel Dates
                        </div>
                        <div class="date-input-group">
                            <div class="form-group">
                                <label for="datepick1">Departure Date</label>
                                <input id="datepick1" name="Departure" required />
                            </div>
                            
                            <div class="form-group">
                                <label for="datepick2">Return Date</label>
                                <input id="datepick2" name="Return" disabled />
                                <p class="form-note">For round trips only</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bus Type -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-bus"></i> Bus Preferences
                        </div>
                        <div class="form-group">
                            <label for="bustype">Bus Type</label>
                            <select id="bustype" name="bustype" required>
                                <option value="0">Select Bus Type</option>
                                <option value="Air Conditioned">Air Conditioned</option>
                                <option value="Ordinary">Ordinary</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" name="submit" class="submit-btn">
                        Book Now <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
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

    <!-- Check if datepickr.js exists before loading it -->
    <script>
        // Simple datepicker fallback if datepickr.js is not available
        document.addEventListener('DOMContentLoaded', function() {
            // Check if datepickr is available
            if (typeof datepickr === 'undefined') {
                console.log('Datepickr not found, using native date inputs');
                document.getElementById('datepick1').type = 'date';
                document.getElementById('datepick2').type = 'date';
            } else {
                // Initialize datepickr if available
                try {
                    new datepickr('datepick1', {
                        'dateFormat': 'Y-m-d'
                    });
                    
                    new datepickr('datepick2', {
                        'dateFormat': 'Y-m-d'
                    });
                } catch (e) {
                    console.error('Datepickr initialization error:', e);
                    // Fallback to native date inputs
                    document.getElementById('datepick1').type = 'date';
                    document.getElementById('datepick2').type = 'date';
                }
            }
        });
    </script>
    
    <!-- Try to load datepickr.js with error handling -->
    <script type="text/javascript" src="js/datepickr.js" onerror="console.log('Failed to load datepickr.js')"></script>
</body>
</html>