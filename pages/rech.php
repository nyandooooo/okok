<?php
require("../inc/fonction.php");
$departements = get_Departements();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Recherche Employé</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f6fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .recherche-box {
      max-width: 720px;
      background-color: #ffffff;
      padding: 2.5rem;
      border-radius: 10px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
      margin: 60px auto;
    }
    h2 {
      text-align: center;
      margin-bottom: 2rem;
      color: #0d6efd;
    }
  </style>
</head>
<body>

  <div class="recherche-box">
    <h2>Recherche Employé</h2>
    <form action="resultat.php" method="GET">
      <div class="mb-3">
        <label for="departement" class="form-label">Département (code ou nom)</label>
        <input type="text" class="form-control" name="departement" id="departement" placeholder="Ex: d007 ou Sales">
      </div>

      <div class="mb-3">
        <label for="nom" class="form-label">Nom de l'employé</label>
        <input type="text" class="form-control" name="nom" id="nom" placeholder="Ex: Smith">
      </div>

      <div class="row">
        <div class="col mb-3">
          <label for="age_min" class="form-label">Âge minimum</label>
          <input type="text" class="form-control" name="age_min" id="age_min" placeholder="Ex: 30">
        </div>
        <div class="col mb-3">
          <label for="age_max" class="form-label">Âge maximum</label>
          <input type="text" class="form-control" name="age_max" id="age_max" placeholder="Ex: 45">
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary mt-3 px-4">Rechercher</button>
      </div>
    </form>
  </div>
</body>
</html>
