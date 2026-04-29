<?php
include 'config.php';

$date = $_POST['date'];
$montant = $_POST['montant'];
$categorie = $_POST['categorie'];

$sql = "INSERT INTO depenses (date_depense, categorie, montant)
VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->execute([$date, $categorie, $montant]);

header("Location: index.html");
?>