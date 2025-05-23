<?php
session_start();

require_once '../components/config.php';

// LOGIN AFHANDELING
if (isset($_POST['login'])) {
    $gebruikersnaam = $_POST['username'];
    $wachtwoord = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE naam = :naam");
    $stmt->bindParam(':naam', $gebruikersnaam);
    $stmt->execute();
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gebruiker && $wachtwoord === $gebruiker['wachtwoord']) {
        // Sla info op in sessie
        $_SESSION['username'] = $gebruikersnaam;
        $_SESSION['is_admin'] = $gebruiker['is_admin']; // <-- boolean waarde

        // Redirect afhankelijk van adminstatus
        if ($_SESSION['is_admin'] == 1) {
            header("Location: ../admin/admin.php"); // Admin wordt doorgestuurd naar admin.php
        } else {
            header("Location:  ../admin/menu-beheer.php"); // Gebruiker wordt doorgestuurd naar admin-menu-beheer.php
        }
        exit;
    } else {
        echo "<p style='color:red;text-align:center;'>Ongeldige gebruikersnaam of wachtwoord.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<header>
    <?php require_once '../components/header.php'; ?>

</header>
<div class="achtergrond-login"><img src="../fotos/background%20menu.jpg" alt="achtergrond"></div>

<h1 id="login-pagina-titel">Login pagina</h1>
<form action="login.php" method="post">

    <div class="container">
        <div>
            <label for="username">Username</label>
            <input type="text" placeholder="Enter Username" name="username" required autocomplete="off">
        </div>
        <div>
            <label for="uname">Password</label>
            <input type="password" placeholder="Enter password" name="password" required autocomplete="off">
        </div>

        <input type="submit" name="login" value="Login">
    </div>

</form>

</body>
</html>


