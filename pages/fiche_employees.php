<?php
require("../inc/fonction.php");
$departement = get_Fiche_Employees($_GET["emp_no"]);
$salaire_historique = get_Salaire_Historique($_GET["emp_no"]);
$employe = $departement[0];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #0095f6;
            --secondary-color: #8e8e8e;
            --bg-color: #fafafa;
            --border-color: #dbdbdb;
            --text-color: #262626;
        }

        body {
            background-color: var(--bg-color);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 935px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .profile-header {
            display: flex;
            flex-direction: row;
            margin-bottom: 44px;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
            border: 1px solid var(--border-color);
            padding: 3px;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 20px;
        }

        .profile-stats {
            display: flex;
            margin-bottom: 20px;
        }

        .profile-stat {
            margin-right: 40px;
            font-size: 16px;
        }

        .stat-count {
            font-weight: 600;
        }

        .profile-bio {
            font-size: 16px;
            line-height: 1.5;
        }

        .profile-details {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-label {
            color: var(--secondary-color);
            font-weight: 600;
            width: 120px;
            display: inline-block;
        }

        .salary-history {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .salary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .salary-dates {
            color: var(--secondary-color);
            font-size: 14px;
        }

        .salary-amount {
            font-weight: 600;
        }

        @media (max-width: 735px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-avatar {
                margin-right: 0;
                margin-bottom: 20px;
            }

            .profile-stats {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <div class="profile-header">
            <img src="../assets/Capture d’écran du 2025-06-20 16-20-33.png" class="profile-avatar" alt="Photo de profil">
            <div class="profile-info">
                <h1 class="profile-name"><?= htmlspecialchars($employe["first_name"] . " " . $employe["last_name"]) ?></h1>

                <div class="profile-stats">
                    <div class="profile-stat"> <span>ID</span>
                        <span class="stat-count"><?= $employe["emp_no"] ?></span>

                    </div>
                    <div class="profile-stat"><span>Genre</span>
                        <span class="stat-count"><?= $employe["gender"] == 'M' ? 'Homme' : 'Femme' ?></span>

                    </div>
                </div>

                <div class="profile-bio">
                    Employé depuis le <?= date('d/m/Y', strtotime($employe["hire_date"])) ?>
                </div>
            </div>
        </div>

        <div class="profile-details">
            <div class="detail-item">
                <span class="detail-label">Date de naissance</span>
                <span><?= date('d/m/Y', strtotime($employe["birth_date"])) ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Date d'embauche</span>
                <span><?= date('d/m/Y', strtotime($employe["hire_date"])) ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Genre</span>
                <span><?= $employe["gender"] == 'M' ? 'Masculin' : 'Féminin' ?></span>
            </div>
        </div>

        <?php if (!empty($salaire_historique)) { ?>
            <div class="salary-history">
                <h2 class="section-title"><i class="fas fa-money-bill-wave"></i> Historique des salaires</h2>

                <?php foreach ($salaire_historique as $salaire) { ?>
                    <div class="salary-item">
                        <div>
                            <div class="salary-dates">
                                <?= date('d/m/Y', strtotime($salaire["from_date"])) ?> - <?= date('d/m/Y', strtotime($salaire["to_date"])) ?>
                            </div>
                        </div>
                        <div class="salary-amount">
                            <?= number_format($salaire["salary"], 0, ',', ' ') ?> €
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</body>

</html>