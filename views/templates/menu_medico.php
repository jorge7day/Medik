<nav>
    <ul>
        <li><a title="Opcion 2" href="/medik/views/gestor_citas.php">Gestionar Citas</a></li>
        <li><a title="Opcion 2" href="/medik/views/pacientes.php">Gestionar Pacientes</a></li>
        <li id="last_li">
            <a title="Opcion 2" href="/medik/php/logout.php">
                    <?php
                    session_start();
                    echo strtoupper($_SESSION["usuario"]) . " &brvbar; Cerrar Sesión";
                    ?>
            </a>
        </li>
    </ul>
</nav>
