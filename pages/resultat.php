<?php
require("../inc/fonction.php");

$departement = $_GET['departement'] ?? '';
$nom = $_GET['nom'] ?? '';
$age_min = $_GET['age_min'] ?? '';
$age_max = $_GET['age_max'] ?? '';

$resultats = rechercherEmployes($departement, $nom, $age_min, $age_max);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultats de recherche</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .title {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 30px;
      color: #0d6efd;
      font-weight: 600;
    }
    .card {
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .card-title {
      color: #0d6efd;
      font-size: 1.25rem;
      font-weight: 500;
    }
    .btn-retour {
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="title">Résultats de la recherche</h2>

    <?php
    if (empty($resultats)) {
      echo '<div class="alert alert-warning text-center">Aucun employé trouvé avec ces critères.</div>';
    } else {
      echo '<div class="row">';
      foreach ($resultats as $emp) {
    ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($emp["first_name"] . " " . $emp["last_name"]) ?></h5>
              <p class="mb-1"><strong>Numéro :</strong> <?= $emp["emp_no"] ?></p>
              <p class="mb-1"><strong>Département :</strong> <?= $emp["dept_name"] ?></p>
              <p class="mb-0"><strong>Âge :</strong> <?= $emp["age"] ?> ans</p>
            </div>
          </div>
        </div>
    <?php
      }
      echo '</div>';
    }
    ?>

    <div class="text-center btn-retour">
      <a href="rech.php" class="btn btn-outline-primary px-4">🔍 Nouvelle recherche</a>
    </div>
  </div>
</body>
</html>
