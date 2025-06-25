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
              AND dept_manager.to_date = (SELECT MAX(to_date) FROM dept_manager WHERE dept_no = departments.dept_no)";

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
    WHERE departments.dept_no = '$code' LIMIT 20, 10;";

    return tab($sql);
}


function get_Fiche_Employees($code)
{
    $sql = "SELECT *from employees 
    where emp_no = '$code'";

    return tab($sql);
}

