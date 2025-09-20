<?php
$pdo = require_once 'db.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Activer les erreurs PHP (utile pour debug local)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupération des champs texte
$diplomaName = $_POST['course_name'] ?? null;
$diplomaDescription = $_POST['course_description'] ?? null;

if (!$courseName || !$courseDescription) {
    http_response_code(400);
    echo "❌ Champs obligatoires manquants.";
    exit;
}

// Insertion en base de données
$sql = "INSERT INTO course (nomcourse, description) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $courseName);
$stmt->bindParam(2, $courseDomaine);
$stmt->bindParam(3, $courseDescription);


if ($stmt->execute()) {
    echo "✅ Cours/Compétition ajouté avec succès.";
} else {
    echo "❌ Erreur lors de l'enregistrement.";
}
exit;