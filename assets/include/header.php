
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">


                <li class="nav-item">
                    <a class="nav-link   <?php if ($numact == 0) { ?>active<?php } ?>" aria-current="page" href="#">Departments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($numact == 1) { ?>active<?php } ?>" href="#">Employee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($numact == 2) { ?>active<?php } ?>" aria-disabled="true">Recherche</a>
                </li>
            </ul>
        </div>
    </div>
</nav>