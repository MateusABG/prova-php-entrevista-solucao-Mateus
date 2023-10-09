<head>
    <title> Home </title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="javascript/functions.js"></script>
</head>

<header class="header">
    <img src="https://www.versotech.com.br/wp-content/themes/bones/library/images/logotipo.svg" class="imagem" />
    <link rel="icon" href="https://www.versotech.com.br/wp-content/uploads/2022/10/cropped-icone-logo-32x32.png" sizes="32x32">
</header>

<main class="body">
    <div class="pageicon d-flex justify-content-between">
        <h3>Usuários</h3>
        <div class='button'>
            <a href='pages/inserir_usuario.php' title="Adicionar novo usuário"> Adicionar novo usuário <i class='fa fa-plus-square' aria-hidden='true'></i></a>
        </div>
    </div>
    <div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <div>
                    <?php

                    require 'connection.php';

                    $connection = new Connection();

                    $users = $connection->query("SELECT * FROM users");

                    echo "<div>
                            <table class='table table-striped table-bordered responsive'> 
                                <tr class='text-uppercase text-center'>
                                    <th>ID</th>    
                                    <th>Nome</th>    
                                    <th>Email</th> 
                                    <th>Ação</th>    
                                </tr>
                            ";

                    foreach ($users as $user) {

                        echo sprintf("<tr>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td class='text-center'>
                                            <a href='pages/editar.php?id=%s'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                            <a href='pages/cores.php?id=%s'><i class='fa fa-paint-brush' aria-hidden='true'></i></a>
                                            <a onclick=\"popUpConfirm('%s', %s)\" href='#'><i class='fa fa-trash' aria-hidden='true'></i></a>
                                        </td>
                                    </tr>",
                                    $user->id,
                                    $user->name,
                                    $user->email,
                                    $user->id,
                                    $user->id,
                                    $user->name,
                                    $user->id
                        );
                    }

                    echo "</table></div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p> Feito por <a href="https://www.linkedin.com/in/mateus-alves-bittencourt-gaut%C3%A9rio-2b329214a/"
                style="text-decoration:none;color:black;"><b>Mateus Alves Bittencourt Gautério</b></a> @ Outubro de 2023
        </p>
    </div>
</main>