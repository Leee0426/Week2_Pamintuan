<?php
session_start();
// Database connection
$con = mysqli_connect("localhost", "root", "", "users_db");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is admin
$is_admin = false;
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $user_query = mysqli_query($con, "SELECT role FROM members WHERE email='$email'");
    $user_data = mysqli_fetch_assoc($user_query);
    $is_admin = ($user_data['role'] == 'admin');
}

// Handle content updates
if($is_admin && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['section']) && isset($_POST['content'])) {
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $new_content = mysqli_real_escape_string($con, $_POST['content']);
    
    // Get old content from the page (you might want to store this in a database)
    $old_content = "";
    if($section == "mission") $old_content = "To provide superior transport service to Metro Manila and Mindoro Province commuters.";
    if($section == "vision") $old_content = "To lead the bus transport industry through its innovation service to the riding public.";
    if($section == "history") $old_content = "Photo taken on October 16, 1993. Napat Transit (now Dimple Star Transport) NVR-963 (fleet No 800) going to Alabang and jeepneys under the Light Rail Line in Taft Ave near United Nations Avenue, Ermita, Manila, Philippines. Year 2004 of May changes has been made, Napat Transit became Dimple Star Transport.";
    
    // Save to audit trail
    $audit_sql = "INSERT INTO about_page_edits (admin_email, section, old_content, new_content) 
                  VALUES ('$email', '$section', '$old_content', '$new_content')";
    mysqli_query($con, $audit_sql);
    
    // In a real implementation, you would save this to a database
    // For now, we'll just set session variables to show the updated content
    $_SESSION['about_'.$section] = $new_content;
    
    // Redirect to avoid form resubmission
    header("Location: about.php");
    exit();
}

// Get content (in a real app, this would come from a database)
$mission_content = isset($_SESSION['about_mission']) ? $_SESSION['about_mission'] : "To provide superior transport service to Metro Manila and Mindoro Province commuters.";
$vision_content = isset($_SESSION['about_vision']) ? $_SESSION['about_vision'] : "To lead the bus transport industry through its innovation service to the riding public.";
$history_content = isset($_SESSION['about_history']) ? $_SESSION['about_history'] : "Photo taken on October 16, 1993. Napat Transit (now Dimple Star Transport) NVR-963 (fleet No 800) going to Alabang and jeepneys under the Light Rail Line in Taft Ave near United Nations Avenue, Ermita, Manila, Philippines. Year 2004 of May changes has been made, Napat Transit became Dimple Star Transport.";

// Get edit history
$edit_history = array();
if($is_admin) {
    $history_query = mysqli_query($con, "SELECT * FROM about_page_edits ORDER BY edit_date DESC LIMIT 10");
    while($row = mysqli_fetch_assoc($history_query)) {
        $edit_history[] = $row;
    }
}
?>
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
        
        /* Admin Controls */
        .admin-controls {
            background: #f8d7da;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }
        
        .admin-controls h3 {
            color: #dc3545;
            margin-bottom: 10px;
        }
        
        .admin-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .edit-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .edit-btn:hover {
            background: var(--primary-dark);
        }
        
        .history-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .history-btn:hover {
            background: #5a6268;
        }
        
        /* Edit Form */
        .edit-form {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.2);
            margin: 20px 0;
        }
        
        .edit-form textarea {
            width: 100%;
            min-height: 150px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
            font-family: inherit;
            resize: vertical;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .save-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .save-btn:hover {
            background: #218838;
        }
        
        .cancel-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .cancel-btn:hover {
            background: #5a6268;
        }
        
        /* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 25px;
    border: 1px solid #888;
    width: 90%;
    max-width: 900px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    max-height: 85vh;
    display: flex;
    flex-direction: column;
}

.modal-header {
    padding: 0;
    margin: 0 0 20px 0;
    border-bottom: 2px solid #eee;
    position: relative;
}

.modal-body {
    overflow-y: auto;
    flex-grow: 1;
    max-height: 65vh;
    padding: 5px;
}

/* History table */
.history-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.history-table th, .history-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.history-table th {
    background-color: #f2f2f2;
    font-weight: bold;
    position: sticky;
    top: 0;
    z-index: 10;
}

.history-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.history-table tr:hover {
    background-color: #f1f1f1;
}

/* Changes column */
.history-table td:nth-child(4) {
    max-width: 350px;
}

.changes-content {
    max-height: 100px;
    overflow-y: auto;
    padding: 8px;
    background: #f8f9fa;
    border-radius: 4px;
    border: 1px solid #e9ecef;
}

.changes-content p {
    margin: 0 0 8px 0;
}

.changes-content p:last-child {
    margin-bottom: 0;
}

/* Close button */
.close {
    color: #aaa;
    position: absolute;
    top: -10px;
    right: 0;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    background: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.close:hover {
    color: black;
    background: #f1f1f1;
}
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .history-table th, .history-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        .history-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .history-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .history-table tr:hover {
            background-color: #f1f1f1;
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
        <?php if($is_admin): ?>
        <div class="admin-controls">
            <h3><i class="fas fa-cog"></i> Admin Controls</h3>
            <div class="admin-buttons">
                <button class="edit-btn" onclick="showEditForm('mission')">Edit Mission</button>
                <button class="edit-btn" onclick="showEditForm('vision')">Edit Vision</button>
                <button class="edit-btn" onclick="showEditForm('history')">Edit History</button>
                <button class="history-btn" onclick="showEditHistory()">View Edit History</button>
            </div>
        </div>
        
        <div id="mission-form" class="edit-form">
            <h3>Edit Mission</h3>
            <form method="POST">
                <input type="hidden" name="section" value="mission">
                <textarea name="content"><?php echo $mission_content; ?></textarea>
                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="hideEditForm('mission')">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
        
        <div id="vision-form" class="edit-form">
            <h3>Edit Vision</h3>
            <form method="POST">
                <input type="hidden" name="section" value="vision">
                <textarea name="content"><?php echo $vision_content; ?></textarea>
                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="hideEditForm('vision')">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
        
        <div id="history-form" class="edit-form">
            <h3>Edit History</h3>
            <form method="POST">
                <input type="hidden" name="section" value="history">
                <textarea name="content"><?php echo $history_content; ?></textarea>
                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="hideEditForm('history')">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
        
        <div id="history-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit History</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <?php if(count($edit_history) > 0): ?>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Admin</th>
                        <th>Section</th>
                        <th>Changes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($edit_history as $edit): ?>
                    <tr>
                        <td><?php echo date('M j, Y g:i A', strtotime($edit['edit_date'])); ?></td>
                        <td><?php echo htmlspecialchars($edit['admin_email']); ?></td>
                        <td><?php echo ucfirst($edit['section']); ?></td>
                        <td>
                            <div class="changes-content">
                                <p><strong>Before:</strong> <?php echo htmlspecialchars($edit['old_content']); ?></p>
                                <p><strong>After:</strong> <?php echo htmlspecialchars($edit['new_content']); ?></p>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No edit history found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
        <?php endif; ?>
        
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
                    <p><?php echo $mission_content; ?></p>
                </div>
                
                <div class="mission-vision-card">
                    <h3><i class="fas fa-eye"></i> Vision</h3>
                    <p><?php echo $vision_content; ?></p>
                </div>
            </div>
        </div>
        
        <div class="history-section">
            <h3><i class="fas fa-history"></i> History</h3>
            <p><?php echo $history_content; ?></p>
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
        function showEditForm(section) {
            // Hide all forms first
            document.querySelectorAll('.edit-form').forEach(form => {
                form.style.display = 'none';
            });
            
            // Show the selected form
            document.getElementById(section + '-form').style.display = 'block';
        }
        
        function hideEditForm(section) {
            document.getElementById(section + '-form').style.display = 'none';
        }
        
        function showEditHistory() {
            document.getElementById('history-modal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('history-modal').style.display = 'none';
        }
        
        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('history-modal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>