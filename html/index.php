<?php
$servername = "mysql_db";
$username = "root";
$password = "rootpassword";

try {
    $conn = new PDO("mysql:host=$servername;dbname=restaurant", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // You can log the error internally but display a user-friendly message
    echo "Er is een probleem met de verbinding. Probeer het later opnieuw.";
    exit; // Terminate further execution to avoid errors
}

$sql = "SELECT * FROM gerechten";
$stmt = $conn->query($sql);
$menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Mallanna' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title>MẮM Vietnamese Street Food</title>
</head>

<body>
<header>
    <?php require_once 'components/header.php'; ?>


</header>


<div class="logo-homepage">
    <img src="fotos/homepage background.png" alt="Homepage Background" class="homepage-achtergrond">
    <div class="homepage-overlay">
        <div id="hp-titel">
            <h1>MẮM</h1>
        </div>
        <hr>
        <p>Vietnamese Street Food</p>
    </div>
</div>

<div class="menu-section">
    <img src="fotos/background menu.jpg" alt="Menu Background" class="menu-background">
    <div class="menu-overlay">
        <div class="menu-cards">
            <div class="menu-card">
                <h3><span class="line"></span>PHỞ /BÚN BÒ HUẾ</h3>
                <p>A delicious noodle soup with a homemade broth and lots of love</p>
            </div>
            <div class="menu-card">
                <h3><span class="line"></span>BÁNH MÌ</h3>
                <p>Delicious fresh homemade bread straight from the oven</p>
            </div>
            <div class="menu-card">
                <h3><span class="line"></span>BÚN/CƠM</h3>
                <p>Freshly cooked rice or noodles with fresh vegetables and love</p>
            </div>
        </div>
        <a href="menu.php" class="menu-button">Click for Menu</a>
    </div>
</div>

<footer class="mam-footer">
    <div class="footer-content">
        <div class="footer-links">
            <h4>MẮM STREET FOOD</h4>
            <p>Augustijnenstraat 43<br>6511 KE Nijmegen</p>
            <p>+31 24 206 4723<br>info@mamstreetfood.com</p>
        </div>

        <div class="footer-middel">
            <h4>Andere Links</h4>
            <a href="homepage.php">Home</a><br>
            <a href="menu.php">Home</a><br>
            <a href="index.php">Menu</a>
        </div>

        <div class="footer-rechts">
            <h4>VOLG ONS</h4>
            <div class="social-icons">
                <a href="https://www.facebook.com/MAMVietnameseStreetFood/"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/mamstreetfood/"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

</body>

</html>
