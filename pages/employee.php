<?php
require("../inc/fonction.php");

// Paramètres de pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8; // Nombre d'employés par page
$offset = ($page - 1) * $limit;

// Paramètre de recherche
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Récupération des employés (vous devrez adapter cette fonction pour inclure pagination et recherche)
$departement = get_Employees_dep($_GET["dept_no"], $offset, $limit, $search);
$total_employees = count_Employees_dep($_GET["dept_no"], $search); // Fonction pour compter le total
$total_pages = ceil($total_employees / $limit);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés - <?= htmlspecialchars($departement[0]["dept_name"] ?? 'Département'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .header {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .department-title {
            font-size: 2rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .employee-count {
            color: #6c757d;
            font-size: 1rem;
        }

        .search-section {
            background: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #dee2e6;
        }

        .search-form {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 1rem;
        }

        .search-input:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-search {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-search:hover {
            background: #0b5ed7;
        }

        .btn-clear {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-clear:hover {
            background: #5a6268;
        }

        .employee-card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .employee-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .employee-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #6c757d;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 auto 1rem;
        }

        .employee-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .employee-name a {
            color: #495057;
            text-decoration: none;
        }

        .employee-name a:hover {
            color: #0d6efd;
        }

        .employee-id {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .btn-profile {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-block;
        }

        .btn-profile:hover {
            background: #0b5ed7;
            color: white;
        }

        .pagination-section {
            background: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid #dee2e6;
            text-align: center;
        }

        .pagination-info {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .pagination-controls {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .page-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #495057;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .page-btn:hover {
            background: #e9ecef;
            color: #495057;
        }

        .page-btn.active {
            background: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }

        .page-btn.disabled {
            background: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                align-items: stretch;
            }
            
            .pagination-controls {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <h1 class="department-title">
                <i class="bi bi-building me-2"></i>
                <?= htmlspecialchars($departement[0]["dept_name"] ?? 'Département'); ?>
            </h1>
            <p class="employee-count">
                <?= $total_employees; ?> employé<?= $total_employees > 1 ? 's' : ''; ?> au total
            </p>
        </div>
    </div>

    <div class="container">
        <!-- Recherche -->
        <div class="search-section">
            <form class="search-form" method="GET">
                <input type="hidden" name="dept_no" value="<?= htmlspecialchars($_GET["dept_no"] ?? ''); ?>">
                <input type="text" 
                       name="search" 
                       class="search-input" 
                       placeholder="Rechercher un employé par nom ou prénom..."
                       value="<?= htmlspecialchars($search); ?>">
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Rechercher
                </button>
                <?php if (!empty($search)) : ?>
                    <a href="?dept_no=<?= htmlspecialchars($_GET["dept_no"]); ?>" class="btn-clear">
                        <i class="bi bi-x"></i> Effacer
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Liste des employés -->
        <?php if (!empty($departement)) : ?>
            <div class="row">
                <?php foreach ($departement as $employee) : 
                    $initials = strtoupper(substr($employee["first_name"], 0, 1));
                    if (!empty($employee["last_name"])) {
                        $initials .= strtoupper(substr($employee["last_name"], 0, 1));
                    }
                ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="employee-card">
                            <div class="employee-avatar">
                                <?= $initials ?>
                            </div>
                            
                            <h3 class="employee-name">
                                <a href="fiche_employees.php?emp_no=<?= $employee["emp_no"]; ?>">
                                    <?= htmlspecialchars($employee["first_name"]); ?> 
                                    <?= htmlspecialchars($employee["last_name"] ?? ""); ?>
                                </a>
                            </h3>
                            
                            <div class="employee-id">
                                ID: <?= $employee["emp_no"]; ?>
                            </div>
                            
                            <a href="fiche_employees.php?emp_no=<?= $employee["emp_no"]; ?>" class="btn-profile">
                                Voir le profil
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1) : ?>
                <div class="pagination-section">
                    <div class="pagination-info">
                        Page <?= $page; ?> sur <?= $total_pages; ?>
                        (<?= $offset + 1; ?>-<?= min($offset + $limit, $total_employees); ?> sur <?= $total_employees; ?> employés)
                    </div>
                    
                    <div class="pagination-controls">
                        <!-- Bouton Précédent -->
                        <?php if ($page > 1) : ?>
                            <a href="?dept_no=<?= htmlspecialchars($_GET["dept_no"]); ?>&page=<?= $page - 1; ?><?= !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                               class="page-btn">
                                <i class="bi bi-chevron-left"></i> Précédent
                            </a>
                        <?php else : ?>
                            <span class="page-btn disabled">
                                <i class="bi bi-chevron-left"></i> Précédent
                            </span>
                        <?php endif; ?>

                        <!-- Numéros de pages -->
                        <?php
                        $start_page = max(1, $page - 2);
                        $end_page = min($total_pages, $page + 2);
                        
                        for ($i = $start_page; $i <= $end_page; $i++) :
                        ?>
                            <a href="?dept_no=<?= htmlspecialchars($_GET["dept_no"]); ?>&page=<?= $i; ?><?= !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                               class="page-btn <?= $i == $page ? 'active' : ''; ?>">
                                <?= $i; ?>
                            </a>
                        <?php endfor; ?>

                        <!-- Bouton Suivant -->
                        <?php if ($page < $total_pages) : ?>
                            <a href="?dept_no=<?= htmlspecialchars($_GET["dept_no"]); ?>&page=<?= $page + 1; ?><?= !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                               class="page-btn">
                                Suivant <i class="bi bi-chevron-right"></i>
                            </a>
                        <?php else : ?>
                            <span class="page-btn disabled">
                                Suivant <i class="bi bi-chevron-right"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-person-x"></i>
                </div>
                <h2>Aucun employé trouvé</h2>
                <p>
                    <?php if (!empty($search)) : ?>
                        Aucun employé ne correspond à votre recherche "<?= htmlspecialchars($search); ?>".
                    <?php else : ?>
                        Ce département ne contient actuellement aucun employé.
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>