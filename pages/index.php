<?php
require("../inc/fonction.php");
$numact;
$departement =  get_Departements_Managers(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments and Managers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $numact = 0;
    include("../assets/include/header.php"); ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Departments and Managers</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Department No</th>
                    <th>Department Name</th>
                    <th>Manager Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departement as $huhu) { ?>
                    <tr>
                        <td>
                            <a href="employee.php?dept_no=<?= $huhu["dept_no"]; ?>" class="text-decoration-none">
                                <?= $huhu["dept_no"]; ?>
                            </a>
                        </td>
                        <td><?= $huhu["dept_name"]; ?></td>
                        <td><?= $huhu["last_name"] . " " . $huhu["first_name"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>