<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$compteType = $_POST['compte_type'] ?? 'perso';
$compteType = $compteType === 'pro' ? 'pro' : 'perso';
$montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);

if ($montant !== false && $montant > 0) {
    $sql = $conn->prepare("INSERT INTO revenus (utilisateur_id, montant, compte_type) VALUES (?, ?, ?)");
    $sql->execute([$_SESSION['user_id'], $montant, $compteType]);
}

header("Location: index.php?compte=" . $compteType);
exit();
?>
