
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

<div class="menu-categorieën">
    <a href="gerecht-paginas/brood.php" class="categorie-blok">
        <img src="fotos/brood.png" alt="Brood">
        <h3>Brood</h3>
    </a>
    <a href="gerecht-paginas/noodles.php" class="categorie-blok">
        <img src="fotos/bun.png" alt="Noodles">
        <h3>Noodles</h3>
    </a>
    <a href="gerecht-paginas/rijst.php" class="categorie-blok">
        <img src="fotos/rijst.jpg" alt="Rijst">
        <h3>Rijst</h3>
    </a>
    <a href="gerecht-paginas/soep.php" class="categorie-blok">
        <img src="fotos/pho.png" alt="Soep">
        <h3>Soep</h3>
    </a>
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

