<?php
require_once '../components/config.php';

$sql = "SELECT gerechten.naam, gerechten.prijs 
        FROM gerechten 
        JOIN gerechtsoorten ON gerechten.gerechtsoort_id = gerechtsoorten.id 
        WHERE gerechtsoorten.naam = 'Brood-gerechten'
        ORDER BY gerechten.naam ASC";

$stmt = $conn->query($sql);
$gerechten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banh Mi Gerechten</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


<header>
    <?php require_once("menu-header.php") ?>
</header>

<div class="header-foto">
    <img src="../fotos/background%20foto.png" alt="Restaurant Achtergrond">
</div>

<input type="text" id="searchInput" placeholder="Zoek Banh Mi..." class="search-menu-input" aria-label="Zoek banh mi op naam">
<?php if (!empty($gerechten)): ?>
    <div class="menu-container">
        <?php foreach ($gerechten as $item): ?>
            <div class="menu-item">
                <h3><?= htmlspecialchars($item['naam']) ?></h3>
                <p>Prijs: € <?= number_format($item['prijs'], 2, ',', '.') ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Er staan momenteel geen broodgerechten op het menu.</p>
<?php endif; ?>

<header><?php require_once("../components/footer.php") ?>
</header>

<script>
    const searchInput = document.getElementById('searchInput');
    const items = document.querySelectorAll('.menu-item');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();

        items.forEach(item => {
            const name = item.querySelector('h3').textContent.toLowerCase();
            item.style.display = name.includes(searchTerm) ? 'block' : 'none';
        });
    });
</script>

</body>
</html>
