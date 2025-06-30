<?php
require("co.php");

function tab($sql)
{
    $membre_req = mysqli_query(dbconnect(), $sql);
    $result = [];
    while ($membre = mysqli_fetch_assoc($membre_req)) {
        $result[] = $membre;
    }

    return $result;
}
function get_Departements()
{
    $sql = "SELECT * from departments";
    return tab($sql);
}

//////////////////////////////////////////

function get_Departements_Managers()
{
    $sql = "SELECT departments.dept_no, departments.dept_name, employees.first_name, employees.last_name
            FROM departments, dept_manager, employees
            WHERE departments.dept_no = dept_manager.dept_no
              AND dept_manager.emp_no = employees.emp_no
              AND dept_manager.to_date = (SELECT MAX(to_date) FROM dept_manager WHERE dept_no = departments.dept_no) ORDER BY departments.dept_no";

    return tab($sql);
}

function get_Departements_Managers1()
{
    $sql = "SELECT departments.dept_no,employees.last_name,employees.first_name, departments.dept_name from departments 
    join dept_manager join employees on departments.dept_no = dept_manager.dept_no 
  and dept_manager.emp_no = employees.emp_no 
  and dept_manager.to_date = (select max(to_date) from dept_manager where dept_no = departments.dept_no)";

    return tab($sql);
}
///////////////////////////////////////////


function get_Employees_dep($code)
{
    $sql = "SELECT employees.emp_no, employees.first_name, departments.dept_no, departments.dept_name 
    FROM employees 
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no 
    JOIN departments ON dept_emp.dept_no = departments.dept_no 
    WHERE departments.dept_no = '$code' ORDER BY employees.first_name ASC;";

    return tab($sql);
}


function get_Fiche_Employees($code)
{
    $sql = "SELECT *from employees 
    where emp_no = '$code'";

    return tab($sql);
}

function get_Salaire_Historique($code)
{
    $sql = "SELECT salary, from_date, to_date FROM salaries WHERE emp_no = '$code' ORDER BY from_date DESC";
    return tab($sql);
} 


function rechercherEmployes($departement, $nom, $age_min, $age_max) {
    $clauses = [];
    $today = date('Y-m-d');
    $currentYear = date('Y');

    if (!empty($departement)) {
        $clauses[] = "(departments.dept_no LIKE '%$departement%' OR departments.dept_name LIKE '%$departement%')";
    }

    if (!empty($nom)) {
        $clauses[] = "(employees.last_name LIKE '%$nom%' OR employees.first_name LIKE '%$nom%')";
    }

    if (!empty($age_min)) {
        $minYear = $currentYear - intval($age_min);
        $clauses[] = "YEAR(employees.birth_date) <= $minYear";
    }

    if (!empty($age_max)) {
        $maxYear = $currentYear - intval($age_max);
        $clauses[] = "YEAR(employees.birth_date) >= $maxYear";
    }

   
    $where = "";
    if (count($clauses) > 0) {
        $where = "WHERE ";
        foreach ($clauses as $index => $clause) {
            if ($index > 0) {
                $where .= " AND ";
            }
            $where .= $clause;
        }
    }

    $sql = "SELECT employees.emp_no, employees.first_name, employees.last_name, employees.birth_date,
            ($currentYear - YEAR(employees.birth_date)) AS age,
            departments.dept_name
            FROM employees
            JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
            JOIN departments ON dept_emp.dept_no = departments.dept_no
            $where
            ORDER BY employees.first_name ASC LIMIT 50";

    return tab($sql);
}




