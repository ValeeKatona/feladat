<?php
require("functions.php");
checkAccess();

$message = '';

if (isset($_POST['changeUsername'])) {
    $newUsername = $_POST['newUsername'];
    $validationResult = validateChangeUsername($newUsername);

    if (empty($validationResult)) {
        $message = changeUsername($newUsername);
    } else {
        $message = $validationResult;
    }
}

if (isset($_POST['changePassword'])) {
    $newPassword = $_POST['newPassword'];
    $validationResult = validateChangePassword($newPassword);

    if (empty($validationResult)) {
        $message = changePassword($newPassword);
    } else {
        $message = $validationResult;
    }
}

if (isset($_POST['deleteAccount'])) {
    $message = deleteAccount();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	<link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
    <title>Prioris - User</title>
    <style>
    .styled-input {
    width: 53%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
    }

    .styled-input:focus {
        border-color: #007BFF;
        outline: none;
    }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="shape-blue"></div>
    <div class="shape-darkblue"></div>
    <div class="shape-yellow"></div>
    <div class="shape-nav-darkblue"></div>
</nav>
<nav class="navbar">
        <a href="index.php" class="navbar-logo">
            <img src="./assets/logo_white.png" alt="logo">
        </a>
        <div class="hamburger-menu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="overlay">
            <ul class="overlay-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="public.php">Public</a></li>
                <li><a href="protected.php">Private</a></li>
                <?php
                if (isset($_SESSION['member'])) {
                    echo '<li><a href="user.php" class="active-mobile">User</a></li>';
                }
            ?>
            </ul>
        </div>
    <div class="navbar-content">
    <div class="navbar-spacer"></div>
        <ul class="navbar-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="public.php">Public</a></li>
            <li><a href="protected.php">Private</a></li>
            <?php
                if (isset($_SESSION['member'])) {
                    echo '<li><a href="user.php" class="active">User</a></li>';
                }
        ?>
        </ul>
        <a href="mailto:contact@valentinkatona.com" class="navbar-button">Email Me</a>
    </div>
</nav>

    <div class="shape-header-1"></div>
    <div class="shape-header-2"></div>
    <div class="shape-nav-2"></div>
    
    <div class="centered-card">
    <div class="card-content">
    <form action="user.php" method="post" onsubmit="return validateChangeUsername(document.getElementById('newUsername').value);">
        <label for="newUsername">Change Username:</label><br><br>
        <input class="styled-input" type="text" id="newUsername" name="newUsername" placeholder="New Username" required><br>
        <button class="btn1" type="submit" name="changeUsername">Change Username</button>
    </form><br>
    <form action="user.php" method="post" onsubmit="return validateChangePassword(document.getElementById('newPassword').value);">
        <label for="newPassword">Change Password:</label><br><br>
        <input class="styled-input" type="password" id="newPassword" name="newPassword" placeholder="New Password" required><br>
        <button class="btn1" type="sumbit" name="changePassword">Change Password</button>
    </form>
    <form id="deleteAccountForm" action="user.php" method="post">
        <button class="btn2" type="sumbit" name="deleteAccount">Delete Account</button>
    </form>
            <?php
                if(!empty($message)){
                    echo '<p>' . $message . '</p>';
                }
            ?>
    </div>
</div>

</body>
<script>
window.addEventListener('scroll', function() {
    const body = document.body;
    if (window.scrollY > 50) {
        body.classList.add('scrolled');
    } else {
        body.classList.remove('scrolled');
    }
});
</script>
<script>
    console.log('PHP Version: <?php echo phpversion(); ?>');
</script>
<script>
    document.getElementById("deleteAccountForm").addEventListener("submit", function (event) {
        if (!confirm("Are you sure you want to delete your account?")) {
            event.preventDefault();
        }
    });
</script>
<script>
    document.querySelector('.hamburger-menu').addEventListener('click', function() {
    const overlay = document.querySelector('.overlay');
    overlay.classList.toggle('active');
    this.classList.toggle('cross');
});
</script>
</html>
