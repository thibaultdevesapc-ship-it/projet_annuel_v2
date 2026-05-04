<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$date = $_POST['date'] ?? '';
$montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
$categorie = $_POST['categorie'] ?? '';
$compteType = $_POST['compte_type'] ?? 'perso';
$compteType = $compteType === 'pro' ? 'pro' : 'perso';

if ($date !== '' && $montant !== false && $montant > 0 && $categorie !== '') {
    $sql = "INSERT INTO depenses (utilisateur_id, date_depense, categorie, montant, compte_type)
    VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $date, $categorie, $montant, $compteType]);
}

header("Location: index.php?compte=" . $compteType);
exit();
?>
