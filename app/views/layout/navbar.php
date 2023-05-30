<nav>
    <ul>
        <?php
            if(isset($_SESSION)) {
                if(isset($_SESSION['islogged'])) {
                    echo "<li><a href=\"/home\">Inicio</a></li>
                        <li><a href=\"/explore\">Explorar</a></li>
                        <li class=\"dropdown\">
                            <a href=\"#\" class=\"dropbtn\">Projetos</a>
                            <div class=\"dropdown-content\">
                                <a href=\"/projects/create\">Criar novo projeto</a>
                                <a href=\"/projects\">Meus projetos</a>
                            </div>
                        </li>
                        <li class=\"dropdown\">
                            <a href=\"#\" class=\"dropbtn\">Perfil</a>
                            <div class=\"dropdown-content\">
                                <a href=\"/settings\">Configurações</a>
                                <a href=\"/logout\">Sair</a>
                            </div>
                        </li>";
                } else {
                    echo "<li><a href=\"/login\">Login</a></li>
                        <li><a href=\"/register\">Cadastre-se</a></li>";
                }
            }
        ?>
    </ul>
</nav>