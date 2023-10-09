<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	<link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
    <title>Prioris - Feladat</title>
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
                <li><a href="index.php" class="active-mobile">Home</a></li>
                <li><a href="public.php">Public</a></li>
                <li><a href="protected.php">Private</a></li>
            </ul>
        </div>
    <div class="navbar-content">
    <div class="navbar-spacer"></div>
        <ul class="navbar-menu">
            <li><a href="index.php" class="active">Home</a></li>
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
        <h2>Autentikációs Middleware</h2>
        <p>Remélem elnyeri tetszésüket ez a kis feladat!:)</p>
        <a href="/feladat.pdf" target="_blank">
            <button class="btn1">Dokumentáció</button>
        </a>
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
