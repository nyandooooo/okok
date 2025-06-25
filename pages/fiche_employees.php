<?php
require("../inc/fonction.php");
$departement =  get_Fiche_Employees($_GET["emp_no"]); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fiche Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"> fiche Employees</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                  
                        <th>Employee No</th>
                  
                    <th>birth_date</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>gender</th>
                    <th>hire_date </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departement as $huhu) { ?>
                    <tr>
                        <td><?= $huhu["emp_no"]; ?></td>
                        <td><?= $huhu["birth_date"]; ?></td>
                        <td><?= $huhu["first_name"]; ?></td>
                        <td><?= $huhu["last_name"]; ?></td>
                        <td><?= $huhu["gender"]; ?></td>
                        <td><?= $huhu["hire_date"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>