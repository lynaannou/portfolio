<?php
$pdo = require_once 'db.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Activer les erreurs PHP (utile pour debug local)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupération des champs texte
$projectName = $_POST['project_name'] ?? null;
$productDescription = $_POST['project_description'] ?? null;

if (!$projectName || !$projectDescription) {
    http_response_code(400);
    echo "❌ Champs obligatoires manquants.";
    exit;
}

// Insertion en base de données
$sql = "INSERT INTO projet (nomprojet, description) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $projectName);
$stmt->bindParam(2, $projectDescription);


if ($stmt->execute()) {
    echo "✅ Projet ajouté avec succès.";
} else {
    echo "❌ Erreur lors de l'enregistrement.";
}
exit;
