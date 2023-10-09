<?php require("functions.php") ?>
<?php 
	if(isset($_SESSION['member'])){
		header('Location: protected.php');
		exit();
	}
?>
<?php
	if(isset($_POST['member-validation'])){
		$response = login($_POST['username'], $_POST['password']);
	}

$message = '';
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $message = register($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	<link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
    <title>Prioris - Login</title>
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
            </ul>
        </div>
    <div class="navbar-content">
    <div class="navbar-spacer"></div>
        <ul class="navbar-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="public.php">Public</a></li>
            <li><a href="protected.php">Private</a></li>
        </ul>
        <a href="mailto:contact@valentinkatona.com" class="navbar-button">Email Me</a>
    </div>
</nav>

    <div class="shape-header-1"></div>
    <div class="shape-header-2"></div>
    <div class="shape-nav-2"></div>
    
    <div class="centered-card">
    <div class="card-content">
        <h1>Login Page</h1>
		<h2>You have to login first!</h2>
        <h3>Please enter your Username and Password</h3>
		<form action="" method="post" autocomplete="off" onsubmit="return validateRegistration();">
				<p>Username: </p>
				<input class="styled-input" type="text" id="username" name="username" placeholder="Username">
				<p>Password: </p>
				<input class="styled-input" type="password" id="password" name="password" placeholder="Password">
				<br>
                <?php if(isset($response) && !empty($response)): ?>
                    <script>
                        alert('<?php echo addslashes($response); ?>');
                    </script>
                <?php endif; ?>


				<button type="submit" name="member-validation" class="btn1">Login</button>
                <button type="submit" name="register" class="btn1">Register</button>
			</form>
            <p id="message" style="color: red;"></p>
            <?php
                if(!empty($message)){
                    echo '<p>' . $message . '</p>';
                }
            ?>
    </div>
</div>

</body>
<script>
    document.querySelector('.hamburger-menu').addEventListener('click', function() {
    const overlay = document.querySelector('.overlay');
    overlay.classList.toggle('active');
    this.classList.toggle('cross');
});
</script>
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
function validateRegistration() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var messageContainer = document.getElementById("message");

    messageContainer.innerText = ""; // Clear any previous error messages

    if (username.trim() === "") {
        messageContainer.innerText = "Username cannot be empty.";
        return false;
    }

    if (username.length < 3) {
        messageContainer.innerText = "Username must be at least 3 characters long.";
        return false;
    }

    if (/[^a-zA-Z0-9]/.test(username)) {
        messageContainer.innerText = "Username cannot contain special characters.";
        return false;
    }

    if (username.indexOf(" ") !== -1) {
        messageContainer.innerText = "Username cannot contain spaces.";
        return false;
    }

    if (password.trim() === "") {
        messageContainer.innerText = "Password cannot be empty.";
        return false;
    }

    if (password.length < 6) {
        messageContainer.innerText = "Password must be at least 6 characters long.";
        return false;
    }

    if (!/[A-Z]/.test(password)) {
        messageContainer.innerText = "Password must contain at least 1 uppercase character.";
        return false;
    }

    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
        messageContainer.innerText = "Password must contain at least 1 special character.";
        return false;
    }

    if (!/\d/.test(password)) {
        messageContainer.innerText = "Password must contain at least 1 numeric character.";
        return false;
    }

    return true;
}
</script>
</html>
