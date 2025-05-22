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
<div class="header-foto">
    <img src="fotos/background foto.png" alt="Restaurant Background Photo">
</div>
<div>

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


        <footer>
            <?php require_once 'components/footer.php'; ?>


        </footer>
</body>

</html>
