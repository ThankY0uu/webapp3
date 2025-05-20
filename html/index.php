<?php
require_once 'components/config.php';

$sql = "SELECT * FROM gerechten ORDER BY naam ASC";
$stmt = $conn->query($sql);
$menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="nl">

<head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header><?php require_once("components/header.php") ?>
</header>
<div class="header-foto">
    <img src="fotos/background foto.png" alt="Restaurant Background Photo">
</div>
<input type="text" id="searchInput" placeholder="Zoek op naam..." class="search-menu-input" aria-label="Zoek menu-item op naam">

<div class="menu-content">
    <?php if (!empty($menu)): ?>
        <div class="menu-container">
            <?php foreach ($menu as $item): ?>
                <div class="menu-item">
                    <h3><?= htmlspecialchars($item['naam']) ?></h3>
                    <p>Prijs: € <?= number_format($item['prijs'], 2, ',', '.') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Er staan momenteel geen producten op het menu.</p>
    <?php endif; ?>
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
            <a href="public-paginas/homepage.php">Home</a><br>
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
<script>
    const searchInput = document.getElementById('searchInput');
    const items = document.querySelectorAll('.menu-item');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();

        items.forEach(item => {
            const name = item.querySelector('h3').textContent.toLowerCase();
            if (name.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

</html>

