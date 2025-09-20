<?php
$pdo = require_once 'db.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Activer les erreurs PHP (utile pour debug local)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupération des champs texte
$diplomaName = $_POST['diploma_name'] ?? null;
$diplomaDomaine = $_POST['diploma_domaine'] ?? null;
$diplomaDescription = $_POST['diploma_description'] ?? null;

if (!$diplomaName || !$diplomaDescription || !$diplomaDomaine) {
    http_response_code(400);
    echo "❌ Champs obligatoires manquants.";
    exit;
}

// Insertion en base de données
$sql = "INSERT INTO diplomes (nomdiplome, domaine, description) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $diplomaName);
$stmt->bindParam(2, $diplomaDomaine);
$stmt->bindParam(3, $diplomaDescription);


if ($stmt->execute()) {
    echo "✅ Diplôme ajouté avec succès.";
} else {
    echo "❌ Erreur lors de l'enregistrement.";
}
exit;