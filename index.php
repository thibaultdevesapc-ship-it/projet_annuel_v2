<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$compte = $_GET['compte'] ?? 'perso';
if ($compte === 'pro') {
    $compteType = 'pro';
} else {
    $compteType = 'perso';
}
$autreCompte = $compteType === 'pro' ? 'perso' : 'pro';
$nomCompte = $compteType === 'pro' ? 'Vive PRO' : 'Vive';
$categoriesForm = $compteType === 'pro'
    ? ['Fournitures', 'Transport pro', 'Repas pro', 'Logiciels', 'Loyer pro', 'Factures pro', 'Clients', 'Impôts']
    : ['Courses', 'Transport', 'Divertissement', 'Factures', 'Loyer', 'Restaurant', 'Travail'];

$sqlDepenses = $conn->prepare("SELECT COALESCE(SUM(montant), 0) AS total_depenses FROM depenses WHERE utilisateur_id = ? AND compte_type = ?");
$sqlDepenses->execute([$user_id, $compteType]);
$totalDepenses = (float) $sqlDepenses->fetch()['total_depenses'];

$sqlRevenus = $conn->prepare("SELECT COALESCE(SUM(montant), 0) AS total_revenus FROM revenus WHERE utilisateur_id = ? AND compte_type = ?");
$sqlRevenus->execute([$user_id, $compteType]);
$totalRevenus = (float) $sqlRevenus->fetch()['total_revenus'];

$balance = $totalRevenus - $totalDepenses;

$sqlCategories = $conn->prepare("
    SELECT categorie, SUM(montant) AS total
    FROM depenses
    WHERE utilisateur_id = ? AND compte_type = ?
    GROUP BY categorie
    ORDER BY total DESC
");
$sqlCategories->execute([$user_id, $compteType]);
$categories = $sqlCategories->fetchAll();

$maxCategorie = 0;
foreach ($categories as $categorie) {
    $maxCategorie = max($maxCategorie, (float) $categorie['total']);
}

$sqlHistorique = $conn->prepare("
    SELECT id, date_depense, categorie, montant
    FROM depenses
    WHERE utilisateur_id = ? AND compte_type = ?
    ORDER BY date_depense DESC, id DESC
");
$sqlHistorique->execute([$user_id, $compteType]);
$depenses = $sqlHistorique->fetchAll();
$nbOperations = count($depenses);

function formatEuro(float $montant): string
{
    return number_format($montant, 2, ',', ' ') . '€';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet annuel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="header">
        <div class="header-gauche">
            <h1 class="header-bonjour">Bienvenue</h1>
        </div>

        <div class="header-logo">
            <img src="logo.webp" class="header-logo-image" alt="logo-vive">
            <p class="header-logo-texte"><?= htmlspecialchars($nomCompte) ?></p>
        </div>

        <div class="header-droite">
            <form method="post" action="revenu.php" class="header-revenu">
                <p class="header-revenu-texte">MON REVENU (€)</p>
                <input type="hidden" name="compte_type" value="<?= htmlspecialchars($compteType) ?>">
                <input type="number" name="montant" class="header-revenu-revenu" min="0.01" step="0.01" required>
                <button type="submit" class="header-revenu-bouton">Confirmer</button>
            </form>

            <div class="header-connexion-container">
                <button type="button" class="header-connexion" id="header-connexion-btn">
                    <img src="connexion.webp" class="header-connexion-image" alt="Menu">
                </button>
                <div class="header-connexion-menu" id="header-connexion-menu">
                    <a href="index.php?compte=<?= $autreCompte ?>" class="header-connexion-menu-item">
                        Changer de type de compte
                    </a>
                    <a href="deconnexion.php" class="header-connexion-menu-item">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </section>

    <main class="container">
        <section class="balance">
            <div class="balance-content">
                <p class="balance-content-texte">Balance actuelle</p>
                <p class="balance-content-euro"><?= formatEuro($balance) ?></p>
            </div>
        </section>

        <section class="depenses">
            <div class="depenses-content">
                <p class="depenses-content-texte">Dépenses actuelles</p>
                <p class="depenses-content-euro"><?= formatEuro($totalDepenses) ?></p>
            </div>
        </section>

        <section class="diagramme">
            <h2 class="diagramme-titre">Répartition des dépenses</h2>
            <div class="diagramme-container">
                <?php if ($categories) { ?>
                    <?php foreach ($categories as $categorie) {
                        $totalCategorie = (float) $categorie['total'];
                        $largeur = $maxCategorie > 0 ? max(4, ($totalCategorie / $maxCategorie) * 100) : 0;
                    ?>
                        <div class="row">
                            <span><?= htmlspecialchars($categorie['categorie']) ?></span>
                            <div class="bar-wrap">
                                <div class="bar" style="width: <?= $largeur ?>%;"></div>
                            </div>
                            <p class="prix"><?= formatEuro($totalCategorie) ?></p>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="empty-state">Aucune dépense enregistrée.</p>
                <?php } ?>
            </div>
        </section>

        <section class="formulaire">
            <div class="formulaire-t">
                <h2 class="formulaire-t-titre">Déclarer une dépense</h2>
                <p class="formulaire-t-texte">Remplir ce formulaire vous permet de déclarer toutes vos nouvelles dépenses.</p>
            </div>

            <form method="post" action="form.php" class="formulaire-form">
                <input type="hidden" name="compte_type" value="<?= htmlspecialchars($compteType) ?>">

                <label for="date" class="formulaire-label">DATE</label>
                <input type="date" id="date" name="date" class="formulaire-input-select" required>

                <label for="montant" class="formulaire-label">MONTANT (€)</label>
                <input type="number" id="montant" name="montant" class="formulaire-input-select" min="0.01" step="0.01" required>

                <label for="categorie" class="formulaire-label">CATÉGORIE</label>
                <select id="categorie" name="categorie" class="formulaire-input-select" required>
                    <?php foreach ($categoriesForm as $categorieForm) { ?>
                        <option value="<?= htmlspecialchars($categorieForm) ?>"><?= htmlspecialchars($categorieForm) ?></option>
                    <?php } ?>
                </select>
                <input type="submit" name="valider" value="VALIDER" class="formulaire-bouton">
            </form>
        </section>

        <section class="historique">
            <div class="historique-header">
                <h2 class="historique-header-titre">Historique des dépenses</h2>
                <p class="historique-header-nbOperations"><?= $nbOperations ?> opération<?= $nbOperations > 1 ? 's' : '' ?></p>
            </div>
            <div class="historique-labels">
                <div>DATE</div>
                <div>CATÉGORIE</div>
                <div>MONTANT</div>
                <div>ACTIONS</div>
            </div>
            <?php if ($depenses) { ?>
                <?php foreach ($depenses as $depense) { ?>
                    <div class="historique-depenses">
                        <div class="historique-date"><?= htmlspecialchars($depense['date_depense']) ?></div>
                        <div class="historique-categorie"><?= htmlspecialchars($depense['categorie']) ?></div>
                        <div class="historique-montant"><?= formatEuro((float) $depense['montant']) ?></div>
                        <form method="post" action="supprimer_depense.php">
                            <input type="hidden" name="id" value="<?= (int) $depense['id'] ?>">
                            <input type="hidden" name="compte_type" value="<?= htmlspecialchars($compteType) ?>">
                            <button type="submit" class="historique-supprimer">Supprimer</button>
                        </form>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="historique-empty">Aucune dépense pour ce compte.</p>
            <?php } ?>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>
