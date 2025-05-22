<?php
require_once '../components/config.php';
session_start();

// Gerechtsoorten ophalen voor dropdown
$soortenStmt = $conn->query("SELECT * FROM gerechtsoorten");
$gerechtsoorten = $soortenStmt->fetchAll(PDO::FETCH_ASSOC);

// Toevoegen
if (isset($_POST['add'])) {
    $naam = htmlspecialchars(trim($_POST['naam']));
    $prijs = filter_var($_POST['prijs'], FILTER_VALIDATE_FLOAT);
    $soort = (int)$_POST['gerechtsoort_id'];

    if (!empty($naam) && $prijs !== false && $soort > 0) {
        $sql = "INSERT INTO gerechten (naam, prijs, gerechtsoort_id) VALUES (:naam, :prijs, :gerechtsoort_id)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([':naam' => $naam, ':prijs' => $prijs, ':gerechtsoort_id' => $soort])) {
            $feedback = "Succesvol toegevoegd";
        } else {
            $feedback = "Toevoegen mislukt";
        }
    } else {
        $feedback = "Vul een geldige naam, prijs en gerechtsoort in.";
    }
}

// Bewerken
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $naam = htmlspecialchars(trim($_POST['naam']));
    $prijs = filter_var($_POST['prijs'], FILTER_VALIDATE_FLOAT);
    $soort = (int)$_POST['gerechtsoort_id'];

    if (!empty($naam) && $prijs !== false && $soort > 0) {
        $sql = "UPDATE gerechten SET naam = :naam, prijs = :prijs, gerechtsoort_id = :gerechtsoort_id WHERE id = :id";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([':naam' => $naam, ':prijs' => $prijs, ':gerechtsoort_id' => $soort, ':id' => $id])) {
            $feedback = "Bewerken gelukt :)";
        } else {
            $feedback = "Bewerken mislukt :(";
        }
    } else {
        $feedback = "Vul een geldige naam, prijs en gerechtsoort in.";
    }
}

// Verwijderen
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM gerechten WHERE id = :id";
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link rel="stylesheet" href="css/style.css">
    <title>admin menu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>

    <?php require_once "../components/admin-header.php"; ?>
</header>
<h1 class="titel-adminmenu">Menu Beheer</h1>

<?php if (!empty($feedback)): ?>
    <p class="feedback-admin"><?= $feedback ?></p>
<?php endif; ?>

<h2 class="titel-adminmenu">Nieuw gerecht toevoegen</h2>
<form method="POST" action="">
    <label for="naam">Naam:</label>
    <input type="text" name="naam" required>

    <label for="prijs">Prijs (€):</label>
    <input type="number" name="prijs" step="0.01" required>

    <label for="gerechtsoort_id">Gerechtsoort:</label>
    <select name="gerechtsoort_id" required>
        <option value="">-- Kies soort --</option>
        <?php foreach ($gerechtsoorten as $soort): ?>
            <option value="<?= $soort['id'] ?>"><?= htmlspecialchars($soort['naam']) ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" name="add" value="Toevoegen">
</form>

<h2 class="titel-adminmenu">Bestaande gerechten</h2>
<input type="text" id="searchInput" placeholder="Zoek op naam..." class="search-menu-input">

<div class="table-design">
    <table>
        <thead>
        <tr>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Soort</th>
            <th>Bewerk</th>
            <th>Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($menu as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['naam']) ?></td>
                <td>&euro; <?= number_format($item['prijs'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($item['gerechtsoort_id']) ?></td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="text" name="naam" value="<?= htmlspecialchars($item['naam']) ?>" required>
                        <input type="number" name="prijs" value="<?= $item['prijs'] ?>" step="0.01" required>
                        <select name="gerechtsoort_id" required>
                            <?php foreach ($gerechtsoorten as $soort): ?>
                                <option value="<?= $soort['id'] ?>" <?= $item['gerechtsoort_id'] == $soort['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($soort['naam']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" name="edit" value="Bewerk">
                    </form>
                </td>
                <td>
                    <a id="verwijder-button" href="?delete=<?= $item['id'] ?>" onclick="return confirm('Weet je zeker dat je dit gerecht wilt verwijderen?');">Verwijder</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('table tbody tr');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();
        rows.forEach(row => {
            const nameCell = row.querySelector('td:first-child');
            const name = nameCell.textContent.toLowerCase();
            row.style.display = name.includes(searchTerm) ? '' : 'none';
        });
    });
</script>

</body>
</html>
