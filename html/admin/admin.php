<?php

require_once '../components/config.php';
session_start();


if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "Toegang geweigerd.";
    exit;
}

$host = "db";
$dbname = "restaurant";
$username = "root";
$password = "rootpassword";
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//verwijdern
if (isset($_POST['verwijder'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("SELECT naam FROM gebruikers WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gebruiker && $gebruiker['naam'] !== $_SESSION['username']) {
        $stmt = $conn->prepare("DELETE FROM gebruikers WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
//toevoegen
if (isset($_POST['toevoegen'])) {
    $naam = trim($_POST['nieuwe_naam']);
    $wachtwoord = trim($_POST['nieuw_wachtwoord']);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    if (!empty($naam) && !empty($wachtwoord)) {
        $hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO gebruikers (naam, wachtwoord, is_admin) VALUES (:naam, :wachtwoord, :is_admin)");
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':wachtwoord', $hashed_wachtwoord);
        $stmt->bindParam(':is_admin', $is_admin);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch users
$stmt = $conn->query("SELECT id, naam FROM gebruikers ORDER BY id ASC");
$gebruikers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function confirmDelete() {
            return confirm("Weet je zeker dat je deze gebruiker wilt verwijderen?");
        }
    </script>
</head>
<body>


<header>

    <?php require_once "../components/admin-header.php"; ?>
</header>

<main>
    <div class="titel-adminmenu">
        <h1>Gebruikersbeheer</h1>
    </div>

    <!-- New account form -->
    <form method="post">
        <div class="feedback">
            <h2>Nieuw account aanmaken</h2>
        </div>

        <label for="nieuwe_naam">Gebruikersnaam:</label>
        <input type="text" name="nieuwe_naam" required>

        <label for="nieuw_wachtwoord">Wachtwoord:</label>
        <input type="password" name="nieuw_wachtwoord" required>

        <label>
            <input type="checkbox" name="is_admin"> Admin rechten?
        </label>

        <input type="submit" name="toevoegen" value="Toevoegen">
    </form>

    <div class="table-design">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Gebruikersnaam</th>
                <th>Actie</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($gebruikers as $gebruiker): ?>
                <tr>
                    <td><?= htmlspecialchars($gebruiker['id']) ?></td>
                    <td><?= htmlspecialchars($gebruiker['naam']) ?></td>
                    <td>
                        <?php if ($gebruiker['naam'] !== $_SESSION['username']): ?>
                            <form method="post" onsubmit="return confirmDelete();">
                                <input type="hidden" name="id" value="<?= $gebruiker['id'] ?>">
                                <button type="submit" name="verwijder" id="verwijder-button" class="verwijder-knop">Verwijderen</button>
                            </form>
                        <?php else: ?>
                            (Jezelf)
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>