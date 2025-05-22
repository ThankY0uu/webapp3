<?php
require_once "../components/config.php";
// Toevoegen
if (isset($_POST['add'])) {
    $naam = htmlspecialchars(trim($_POST['naam']));
    $prijs = filter_var($_POST['prijs'], FILTER_VALIDATE_FLOAT);

    if (!empty($naam) && $prijs !== false) {
        $sql = "INSERT INTO menu (naam, prijs) VALUES (:naam, :prijs)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([':naam' => $naam, ':prijs' => $prijs])) {
            $feedback = "Succesvol toegevoegd";
        } else {
            $feedback = "Toevoegen mislukt";
        }
    } else {
        $feedback = "Vul een geldige naam en prijs in.";
    }
}

// Bewerken
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $naam = htmlspecialchars(trim($_POST['naam']));
    $prijs = filter_var($_POST['prijs'], FILTER_VALIDATE_FLOAT);

    if (!empty($naam) && $prijs !== false) {
        $sql = "UPDATE menu SET naam = :naam, prijs = :prijs WHERE id = :id";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([':naam' => $naam, ':prijs' => $prijs, ':id' => $id])) {
            $feedback = "Bewerken gelukt :)";
        } else {
            $feedback = "Bewerken mislukt :(";
        }
    } else {
        $feedback = "Vul een geldige naam en prijs in.";
    }
}

// Verwijderen
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM menu WHERE id = :id";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([':id' => $id])) {
        $feedback = "Gerecht is verwijderd :)";
    } else {
        $feedback = "Verwijderen mislukt :(";
    }
}

// Menu ophalen
$sql = "SELECT * FROM gerechten";
$stmt = $conn->query($sql);
$menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="nl">
<head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <div class="header">
        <div class="links">
            <img class="mamfoto" src="../fotos/mamlogo.png" alt="Logo">
        </div>

        <div class="header-buttons">
            <a href="../inlog/login.php"><img src="../fotos/loginadmin.jpg" alt="Login button"></a>
        </div>
    </div>
</header>

<h1 class="titel-adminmenu">Menu Beheer</h1>

<?php if (!empty($feedback)): ?>
    <p class="feedback-admin"><?= $feedback ?></p>
<?php endif; ?>

<h2 class="titel-adminmenu">Nieuw menu-item toevoegen</h2>
<form method="POST" action="admin-menu-beheer.php">
    <label for="naam">Naam:</label>
    <input type="text" name="naam" id="naam" required>

    <label for="prijs">Prijs (€):</label>
    <input type="number" name="prijs" id="prijs" step="0.01" required>

    <input type="submit" name="add" value="Voeg toe">
</form>

<h2 class="titel-adminmenu">Huidige Menu-items</h2>
<input type="text" id="searchInput" placeholder="Zoek op naam..." class="search-menu-input">
<div class="table-design">
    <table>
        <thead>
        <tr>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Bewerk</th>
            <th>Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($menu as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['naam']) ?></td>
                <td>&euro; <?= number_format($item['prijs'], 2, ',', '.') ?></td>
                <td>
                    <form method="POST" action="admin-menu-beheer.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="text" name="naam" value="<?= htmlspecialchars($item['naam']) ?>" required>
                        <input type="number" name="prijs" value="<?= htmlspecialchars($item['prijs']) ?>" step="0.01" required>
                        <input type="submit" name="edit" value="Bewerk">
                    </form>
                </td>
                <td>
                    <a id="verwijder-button" href="admin-menu-beheer.php?delete=<?= $item['id'] ?>" onclick="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">Verwijder</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
<script>
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('table tbody tr');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();

        rows.forEach(row => {
            const nameCell = row.querySelector('td:first-child');
            const name = nameCell.textContent.toLowerCase();

            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</html>


