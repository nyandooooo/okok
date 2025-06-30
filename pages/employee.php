<?php
require("../inc/fonction.php");
$departement = get_Employees_dep($_GET["dept_no"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $numact = 1;
    include("../assets/include/header.php"); ?>
    <div class="container py-5">
        <h1 class="text-center mb-5">Employees in <?= $departement[0]["dept_name"]; ?></h1>
        <div class="row g-4">
            <?php foreach ($departement as $huhu) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="fiche_employees.php?emp_no=<?= $huhu["emp_no"]; ?>" class="text-decoration-none">
                                    <?= $huhu["first_name"]; ?>
                                </a>
                            </h5>
                            <p class="card-text mb-1"><strong>Employee No:</strong> <?= $huhu["emp_no"]; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>