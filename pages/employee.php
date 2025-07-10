<?php
require("../inc/fonction.php");
$departement = get_Employees_dep($_GET["dept_no"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés - <?= htmlspecialchars($departement[0]["dept_name"]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --surface-color: #ffffff;
            --background-color: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-strong: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--background-color);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Header Section */
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0 6rem;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><path d="M0,50 Q250,0 500,50 T1000,50 L1000,100 L0,100 Z"/></svg>');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: bottom;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .department-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .department-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            font-weight: 400;
        }

        .stats-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            margin-top: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-top: -3rem;
            position: relative;
            z-index: 3;
        }

        /* Employee Cards */
        .employee-card {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .employee-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .employee-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-strong);
            border-color: transparent;
        }

        .employee-card:hover::before {
            transform: scaleX(1);
        }

        .employee-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 600;
            color: white;
            position: relative;
            box-shadow: var(--shadow-medium);
        }

        .employee-avatar::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: var(--primary-gradient);
            border-radius: 50%;
            z-index: -1;
        }

        .employee-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .employee-name a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .employee-name a:hover {
            color: #667eea;
        }

        .employee-id {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .employee-actions {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .btn-view-profile {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-light);
        }

        .btn-view-profile:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--surface-color);
            border-radius: 1.5rem;
            border: 1px solid var(--border-color);
            margin-top: 2rem;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .department-title {
                font-size: 2rem;
            }
            
            .employee-card {
                padding: 1.5rem;
            }
            
            .employee-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.25rem;
            }
            
            .header-section {
                padding: 2rem 0 4rem;
            }
            
            .main-content {
                margin-top: -2rem;
            }
        }

        /* Animation pour l'apparition des cartes */
        .employee-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Styles pour différents avatars */
        .avatar-variant-1 { background: var(--primary-gradient); }
        .avatar-variant-2 { background: var(--secondary-gradient); }
        .avatar-variant-3 { background: var(--success-gradient); }
        .avatar-variant-4 { background: var(--warning-gradient); }
    </style>
</head>
<body>
    <!-- Header Section -->
    <section class="header-section">
        <div class="container">
            <div class="header-content text-center">
                <h1 class="department-title">
                    <i class="bi bi-building me-3"></i>
                    <?= htmlspecialchars($departement[0]["dept_name"]); ?>
                </h1>
                <p class="department-subtitle">
                    Découvrez l'équipe talentueuse de ce département
                </p>
                <div class="stats-badge">
                    <i class="bi bi-people-fill me-2"></i>
                    <span><?= count($departement); ?> employé<?= count($departement) > 1 ? 's' : ''; ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="main-content">
        <div class="container">
            <?php if (!empty($departement)) : ?>
                <div class="row g-4">
                    <?php 
                    $avatarVariants = ['avatar-variant-1', 'avatar-variant-2', 'avatar-variant-3', 'avatar-variant-4'];
                    foreach ($departement as $index => $employee) {
                        // Génère les initiales pour l'avatar
                        $initials = strtoupper(substr($employee["first_name"], 0, 1));
                        if (!empty($employee["last_name"])) {
                            $initials .= strtoupper(substr($employee["last_name"], 0, 1));
                        }
                        
                        // Sélectionne une variante d'avatar
                        $avatarClass = $avatarVariants[$index % count($avatarVariants)];
                    ?>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="employee-card">
                                <div class="employee-avatar <?= $avatarClass ?>">
                                    <?= $initials ?>
                                </div>
                                
                                <h3 class="employee-name">
                                    <a href="fiche_employees.php?emp_no=<?= $employee["emp_no"]; ?>">
                                        <?= htmlspecialchars($employee["first_name"]); ?> 
                                        <?= htmlspecialchars($employee["last_name"] ?? ""); ?>
                                    </a>
                                </h3>
                                
                                <div class="employee-id">
                                    <i class="bi bi-person-badge"></i>
                                    <span>ID: <?= $employee["emp_no"]; ?></span>
                                </div>
                                
                                <div class="employee-actions">
                                    <a href="fiche_employees.php?emp_no=<?= $employee["emp_no"]; ?>" class="btn-view-profile">
                                        <i class="bi bi-eye"></i>
                                        Voir le profil
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php else : ?>
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-person-x"></i>
                    </div>
                    <h2 class="empty-state-title">Aucun employé trouvé</h2>
                    <p class="empty-state-text">
                        Ce département ne contient actuellement aucun employé.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>