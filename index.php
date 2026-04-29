<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

?>
<?php

$user_id = $_SESSION['user_id'];

// Total dépenses
$sqlDepenses = $conn->prepare("SELECT SUM(montant) AS total_depenses FROM depenses WHERE utilisateur_id = ?");
$sqlDepenses->execute([$user_id]);
$totalDepenses = $sqlDepenses->fetch()['total_depenses'] ?? 0;

// Total revenus
$sqlRevenus = $conn->prepare("SELECT SUM(montant) AS total_revenus FROM revenus WHERE utilisateur_id = ?");
$sqlRevenus->execute([$user_id]);
$totalRevenus = $sqlRevenus->fetch()['total_revenus'] ?? 0;

// Balance
$balance = $totalRevenus - $totalDepenses;
?>

<!DOCTYPE html>
<html lang="en">
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
            <img src="logo.webp" class="header-logo-image">
            <p class="header-logo-texte">Vive</p>
        </div>
        

        <div class="header-droite">
            <div class="header-revenu">
                <p class="header-revenu-texte">MON REVENU (€)</p>
                <input type="number" class="header-revenu-revenu">
                <button type="submit" class="header-revenu-bouton">Confirmer</button>
            </div>

            <div class="header-connexion">
                <img href="#" src="connexion.webp" class="header-connexion-image">
            </div>
        </div>
    </section>

    <main class="container">
        <section class="balance">
            <div class="balance-content">
                <p class="balance-content-texte">Balance actuelle</p>
                <p class="balance-content-euro"><?php echo number_format($balance, 2, ',', ' '); ?>€</p>
            </div>
        </section>

        <section class="depenses">
            <div class="depenses-content">
                <p class="depenses-content-texte">Dépenses actuelles</p>
                <p class="depenses-content-euro"><?php echo number_format($totalDepenses, 2, ',', ' '); ?>€</p>
            </div>
        </section>

        <section class="diagramme">
            <h2 class="diagramme-titre">Répartition des dépenses</h2>
            <div class="diagramme-container">
                <div class="row">
                    <span>Courses</span>
                    <div class="bar" style="width: 55%;"></div>
                    <p class="prix">275,00€</p>
                </div>
                <div class="row">
                    <span>Transport</span>
                    <div class="bar" style="width: 20%;"></div>
                    <p class="prix">100,00€</p>
                </div>
                <div class="row">
                    <span>Divertissement</span>
                    <div class="bar" style="width: 10%;"></div>
                    <p class="prix">50,00€</p>
                </div>
                <div class="row">
                    <span>Loyer</span>
                    <div class="bar" style="width: 8%;"></div>
                    <p class="prix">400,00€</p>
                </div>
                <div class="row">
                    <span>Factures</span>
                    <div class="bar" style="width: 5%;"></div>
                    <p class="prix">25,00€</p>
                </div>
                <div class="row">
                    <span>Travail</span>
                    <div class="bar" style="width: 2%;"></div>
                    <p class="prix">100,00€</p>
                </div>
            </div>
        </section>

        <section class="formulaire">
            <div class="formulaire-t">
                <h2 class="formulaire-t-titre">Déclarer une dépense</h2>
                <p class="formulaire-t-texte">Remplire ce formulaire vous permet de déclarer toutes vos nouvelles dépenses.</p>
            </div>

            <form method="post" action="form.php" class="formulaire-form">

                <label for="date" class="formulaire-label 1">DATE</label>
                <input type="date" id="date" name="date" class="formulaire-input-select 1"/>

                <label for="montant" class="formulaire-label 2">MONTANT (€)</label>
                <input type="number" id="montant" name="montant" class="formulaire-input-select 2"/>

                <label for="categorie" class="formulaire-label 3">CATÉGORIE</label>
                <select id="categorie" name="categorie" class="formulaire-input-select 3">
                    <option value="Courses">Courses</option>
                    <option value="Transport">Transport</option>
                    <option value="Divertissement">Divertissement</option>
                    <option value="Factures">Factures</option>
                    <option value="Loyer">Loyer</option>
                    <option value="Restaurant">Restaurant</option>
                </select>
                <input type="submit" name="valider" value="VALIDER" class="formulaire-bouton"/>
            </form>
        </section>

        <section class="historique">
            <div class="historique-header">
                <h2 class="historique-header-titre">Historique des dépenses</h2>
                <p class="historique-header-nbOperations">1 opération</p>
            </div>
            <div class="historique-labels">
                <div>DATE</div>
                <div>CATÉGORIE</div>
                <div>MONTANT</div>
                <div>ACTIONS</div>
            </div>
            <div class="historique-dépenses">
                <div>2026-01-29</div>
                <div>Nourriture</div>
                <div>100,00€</div>
                <div>Supprimer</div>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>