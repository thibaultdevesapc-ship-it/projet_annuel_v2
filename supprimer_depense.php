<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$compteType = $_POST['compte_type'] ?? 'perso';
$compteType = $compteType === 'pro' ? 'pro' : 'perso';

if ($id) {
    $sql = $conn->prepare("DELETE FROM depenses WHERE id = ? AND utilisateur_id = ? AND compte_type = ?");
    $sql->execute([$id, $_SESSION['user_id'], $compteType]);
}

header("Location: index.php?compte=" . $compteType);
exit();
?>
