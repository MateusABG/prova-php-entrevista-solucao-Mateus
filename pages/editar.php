<!DOCTYPE html>

<head>
    <title>Editar</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="icon" href="../icons/icon.png"/>
</head>

<header name="header" class="header">
    <div name="dados" class="dados">
        <i class="child icon fa fa-book" aria-hidden="true"></i>
        <p class="child">Teste de conhecimentos PHP + Banco de dados</p>
    </div>
</header>

<main>
    <div class="pageicon">
        <h3>Edição de Usuários</h3>
    </div>


    <div name="body" class="body d-flex align-items-center justify-content-center middle-screen-card">
        <div class="space-inside shadow-lg card">
            <form action="_post_processing.php?action=editar_usuario" method="post">
                <?php

                require '../connection.php';

                $connection = new Connection();

                $id = $_GET["id"];

                //DADOS DA PESSOA
                $user = $connection->query("SELECT users.name,users.email FROM users WHERE id=$id");


                foreach ($user as $u) {
                    $usuario = $u->name;
                    $email = $u->email;

                    echo "    
                    <div class='form-group row'>
                        <input type='hidden'  name='id' value='$id'/>
                        <label for='inputName'>Nome</label>
                        <input class='form-control' placeholder='Digite o nome aqui' name='name' value='$usuario'/>
                    </div>
                    <div class='form-group row'>
                        <label for='inputEmail'>Email</label>
                        <input name='email' class='form-control' value='$email'/>
                    </div>
                    <br>";
                }
                ?>
                <button class='form-control form-button' type="submit">
                    EDITAR
                </button>
                <a class="form-control form-button return-button col-md-3" style="margin-top:5px;" href='../index.php'> RETURN </a>
            </form>
        </div>
    </div>

    <div class="footer">
        <p> Feito por <a href="https://www.linkedin.com/in/mateus-alves-bittencourt-gaut%C3%A9rio-2b329214a/"><b>Mateus Alves Bittencourt Gautério</b></a> @ Outubro de 2023
        </p>
    </div>
</main>

</html>