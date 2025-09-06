<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Database connection with error handling
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if database exists, create if it doesn't
$db_check = mysqli_query($con, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'users_db'");
if (mysqli_num_rows($db_check) == 0) {
    $sql = "CREATE DATABASE users_db";
    if (mysqli_query($con, $sql)) {
        mysqli_select_db($con, "users_db");
    } else {
        die("Error creating database: " . mysqli_error($con));
    }
} else {
    mysqli_select_db($con, "users_db");
}

// Create table if it doesn't exist
$table_check = mysqli_query($con, "SHOW TABLES LIKE 'members'");
if (mysqli_num_rows($table_check) == 0) {
    $sql = "CREATE TABLE members (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(50) NOT NULL,
        lname VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        salt VARCHAR(3) NOT NULL,
        password VARCHAR(64) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!mysqli_query($con, $sql)) {
        die("Error creating table: " . mysqli_error($con));
    }
}

$errors = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Check if it's a login request
    if(isset($_POST['login_email']) && isset($_POST['login_password'])) {
        // Login processing
        $login_email = mysqli_real_escape_string($con, $_POST['login_email']);
        $login_password = $_POST['login_password'];
        
        $search_query = mysqli_query($con, "SELECT * FROM members WHERE email = '$login_email'");
        if(mysqli_num_rows($search_query) == 1){
            $user = mysqli_fetch_assoc($search_query);
            $salt = $user['salt'];
            $password = hash('sha256', $salt . hash('sha256', $login_password));
            
            if($password === $user['password']){
                $_SESSION['email'] = $user['email'];
                header("Location: landingpage.php");
                exit();
            } else {
                $login_error = "Invalid email or password.";
            }
        } else {
            $login_error = "Invalid email or password.";
        }
    } 
    // Check if it's a signup request
    else if(isset($_POST['fname']) && isset($_POST['lname'])) {
        // Signup processing
        if(preg_match("/\S+/", $_POST['fname']) === 0){
            $errors['fname'] = "* First Name is required.";
        }
        if(preg_match("/\S+/", $_POST['lname']) === 0){
            $errors['lname'] = "* Last Name is required.";
        }
        if(preg_match("/.+@.+\..+/", $_POST['email']) === 0){
            $errors['email'] = "* Not a valid e-mail address.";
        }
        if(preg_match("/.{8,}/", $_POST['password']) === 0){
            $errors['password'] = "* Password Must Contain at least 8 Characters.";
        }
        if(strcmp($_POST['password'], $_POST['confirm_password'])){
            $errors['confirm_password'] = "* Passwords do not match.";
        }
        
        if(count($errors) === 0){
            $fname = mysqli_real_escape_string($con, $_POST['fname']);
            $lname = mysqli_real_escape_string($con, $_POST['lname']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            
            $password = hash('sha256', $_POST['password']);
            function createSalt(){
                $string = md5(uniqid(rand(), true));
                return substr($string, 0, 3);
            }
            $salt = createSalt();
            $password = hash('sha256', $salt . $password);
            
            $search_query = mysqli_query($con, "SELECT * FROM members WHERE email = '$email'");
            $num_row = mysqli_num_rows($search_query);
            if($num_row >= 1){
                $errors['email'] = "Email address is unavailable.";
            }else{
                $sql = "INSERT INTO members(`fname`, `lname`, `email`, `salt`, `password`) VALUES ('$fname', '$lname', '$email', '$salt', '$password')";
                $query = mysqli_query($con, $sql);
                $_POST['fname'] = '';
                $_POST['lname'] = '';
                $_POST['email'] = '';
                
                $successful = "<div class='success-message'>You are successfully registered. You can now login.</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up / Login - Dimple Star Transport</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <style>
        :root {
            --primary-yellow: #F9A826;
            --primary-yellow-dark: #E8971E;
            --primary-green: #2E7D32;
            --primary-green-dark: #1B5E20;
            --secondary-green: #4CAF50;
            --light: #F8F9FA;
            --dark: #343A40;
            --gray: #6C757D;
            --light-gray: #e9ecef;
            --text-dark: #2C3E50;
            --text-light: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Header Styles */
        header {
            background: var(--primary-green);
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
            color: var(--text-light);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 15px;
        }
        
        nav a:hover, nav a.current {
            background: rgba(255,255,255,0.15);
            color: var(--primary-yellow);
        }
        
        /* Auth Container */
        .auth-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin: 10px 0;
        }
        
        /* Main Content */
        .auth-page {
            padding: 40px 0;
        }
        
        .auth-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-green);
        }
        
        .auth-tab {
            padding: 15px 30px;
            background: var(--light-gray);
            color: var(--text-dark);
            cursor: pointer;
            border-radius: 5px 5px 0 0;
            margin-right: 5px;
            transition: all 0.3s ease;
        }
        
        .auth-tab.active {
            background: var(--primary-green);
            color: var(--text-light);
        }
        
        .auth-content {
            display: none;
            background: white;
            padding: 30px;
            border-radius: 0 8px 8px 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }
        
        .auth-content.active {
            display: block;
        }
        
        .auth-form {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-title {
            color: var(--primary-green);
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus {
            border-color: var(--primary-green);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .submit-btn {
            background: var(--primary-yellow);
            color: var(--text-light);
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
        }
        
        .submit-btn:hover {
            background: var(--primary-yellow-dark);
            transform: translateY(-2px);
        }
        
        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .success-message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .field-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        
        /* Footer */
        footer {
            background: var(--primary-green);
            color: var(--text-light);
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
            opacity: 0.8;
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
        }
        
        @media (max-width: 768px) {
            .auth-tabs {
                flex-direction: column;
            }
            
            .auth-tab {
                margin-bottom: 5px;
                border-radius: 5px;
            }
            
            .auth-content {
                border-radius: 0 0 8px 8px;
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
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="book.php">Book Now</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="auth-page">
            <div class="auth-tabs">
                <div class="auth-tab active" onclick="showTab('login')">Login</div>
                <div class="auth-tab" onclick="showTab('signup')">Sign Up</div>
            </div>
            
            <!-- Login Form -->
            <div class="auth-content active" id="login-content">
                <div class="auth-form">
                    <h2 class="form-title"><i class="fas fa-sign-in-alt"></i> Login to Your Account</h2>
                    
                    <?php if(isset($login_error)): ?>
                        <div class="error-message"><?php echo $login_error; ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($_GET['message'])): ?>
                        <div class="success-message"><?php echo $_GET['message']; ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="signlog.php">
                        <div class="form-group">
                            <label for="login_email">Email Address</label>
                            <input type="email" name="login_email" id="login_email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="login_password">Password</label>
                            <input type="password" name="login_password" id="login_password" required>
                        </div>
                        
                        <button type="submit" class="submit-btn">Login</button>
                    </form>
                </div>
            </div>
            
            <!-- Signup Form -->
            <div class="auth-content" id="signup-content">
                <div class="auth-form">
                    <h2 class="form-title"><i class="fas fa-user-plus"></i> Create New Account</h2>
                    
                    <?php if(isset($successful)): ?>
                        <div class="success-message"><?php echo $successful; ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="signlog.php">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];} ?>" required>
                                <?php if(isset($errors['fname'])): ?>
                                    <span class="field-error"><?php echo $errors['fname']; ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php if(isset($_POST['lname'])){echo $_POST['lname'];} ?>" required>
                                <?php if(isset($errors['lname'])): ?>
                                    <span class="field-error"><?php echo $errors['lname']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="E-mail Address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" required>
                            <?php if(isset($errors['email'])): ?>
                                <span class="field-error"><?php echo $errors['email']; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" required>
                            <?php if(isset($errors['password'])): ?>
                                <span class="field-error"><?php echo $errors['password']; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                            <?php if(isset($errors['confirm_password'])): ?>
                                <span class="field-error"><?php echo $errors['confirm_password']; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <button type="submit" name="submit" class="submit-btn">Create Account</button>
                    </form>
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

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.auth-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.auth-tab').forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(tabName + '-content').classList.add('active');
            
            // Activate selected tab button
            event.currentTarget.classList.add('active');
        }
    </script>
</body>
</html>