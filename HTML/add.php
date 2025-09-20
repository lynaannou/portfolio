<?php
// Get PDO (relative path so it works everywhere)
$pdo = require_once __DIR__ . '/../backend/db.php';

$flashOk = null;
$flashErr = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    // PROJECT form?
    if (isset($_POST['project_name'], $_POST['project_description'])) {
      $sql = 'INSERT INTO public.projet (nomprojet, description)
              VALUES (:n, :d)
              RETURNING idprojet';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':n' => trim($_POST['project_name']),
        ':d' => trim($_POST['project_description'])
      ]);
      
    }

    // DIPLOMA form?
    elseif (isset($_POST['diploma_name'], $_POST['diploma_domaine'], $_POST['diploma_description'])) {
      $sql = 'INSERT INTO public.diplomes (nomdiplome, domaine, description)
              VALUES (:n, :d, :de)
              RETURNING iddiplome';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':n' => trim($_POST['diploma_name']),
        ':d' => trim($_POST['diploma_domaine']),
        ':de' => trim($_POST['diploma_description'])
      ]);
     
    }
  } catch (Throwable $e) {
    http_response_code(500);
    $flashErr = '❌ ' . $e->getMessage();
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="../Style/add.css" />
</head>
<body>
  
    <div class="section">
      
      <h1>Add a Project</h1>
      <div class="add-card">
        
        <form id="add-project-form" method="POST" enctype="multipart/form-data">


        <label for="project-name">Name</label>
        <input type="text" id="project-name" name="project_name" required />

        <label for="project-description">Description</label>
        <textarea id="project-description" name="project_description" rows="5" required></textarea>
        
          <button type="submit">Add</button>
        </form>
      </div>
      
    </div>
    <div class="section">
      
      <h1>Add a Diploma</h1>
      <div class="add-card">
        
        <form id="add-diploma-form" method="POST" enctype="multipart/form-data">


        <label for="diploma-name">Name</label>
        <input type="text" id="diploma-name" name="diploma_name" required />
    <label for="diploma-domaine">Domain</label>
        <input type="text" id="diploma-domaine" name="diploma_domaine" required />

        <label for="diploma-description">Description</label>
        <textarea id="diploma-description" name="diploma_description" rows="5" required></textarea>

            <button type="submit">Add</button>
            </form>
      </div>
      
    </div>
     <div class="section">
      
      <h1>Add a Project</h1>
      <div class="add-card">
        
        <form id="add-product-form" method="POST" enctype="multipart/form-data">


        <label for="product-name">Name</label>
        <input type="text" id="product-name" name="product_name" required />

        <label for="product-description">Description</label>
        <textarea id="product-description" name="product_description" rows="5" required></textarea>
        <input type="file" id="photo-input" name="photo" accept="image/*" hidden />
          <button type="submit">Add</button>
        </form>

          <div class="add-photo" id="photo-drop-area">
            <span class="plus-icon">+</span>
            <input type="file" id="photo-input" name="photo" accept="image/*" hidden />
          </div>
      </div>
      
    </div>
    </body>
</html>