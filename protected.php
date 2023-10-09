<?php require("functions.php") ?>
<?php checkAccess() ?>
<?php
	if(isset($_GET['logout'])){
		logout();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	<link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
    <title>Prioris - Private</title>
</head>
<style>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 420px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

.userText{
    text-decoration: none;
    font-size: 30px;
    text-transform: uppercase;
    color:blue;
    text-decoration: underline wavy hotpink;
}
</style>
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
                <li><a href="protected.php" class="active-mobile">Private</a></li>
                <?php
                if (isset($_SESSION['member'])) {
                    echo '<li><a href="user.php">User</a></li>';
                }
            ?>
            </ul>
        </div>
    <div class="navbar-content">
    <div class="navbar-spacer"></div>
        <ul class="navbar-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="public.php">Public</a></li>
            <li><a href="protected.php" class="active">Private</a></li>
            <?php
                if (isset($_SESSION['member'])) {
                    echo '<li><a href="user.php">User</a></li>';
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
    <div class="tooltip" class="flex-container">
    <h1 style="display: inline;">Welcome,</h1>
    <a href="user.php" class="userText"><?php echo htmlspecialchars($_SESSION['member']); ?></a>
    <span class="tooltiptext">You can click on your Username, to edit your profile!</span>
    </div>
    <h2>This is a: Private Page</h2>
	<h3>Only members can view this page!</h3>
    <p>This is a private content.</p>
    <button class="btn1" onclick="location.href = '?logout' ">Log Out</button>
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
    document.querySelector('.hamburger-menu').addEventListener('click', function() {
    const overlay = document.querySelector('.overlay');
    overlay.classList.toggle('active');
    this.classList.toggle('cross');
});
</script>
</html>
