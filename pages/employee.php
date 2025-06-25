<?php
require("../inc/fonction.php");
$departement =  get_Employees_dep($_GET["dept_no"]); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Employees in Department</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Employee No</th>
                    <th>First Name</th>
                    <th>Department Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departement as $huhu) { ?>
                    <tr>

                        <td> <a href="fiche_employees.php?emp_no=<?= $huhu["emp_no"]; ?>" class="text-decoration-none"><?= $huhu["emp_no"]; ?> </a></td>

                        <td><?= $huhu["first_name"]; ?></td>
                        <td><?= $huhu["dept_name"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>