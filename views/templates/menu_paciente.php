<nav>
    <ul>
        <li><a title="Opcion 1" href="/medik/views/mis_citas.php">Mis Citas</a></li>
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
