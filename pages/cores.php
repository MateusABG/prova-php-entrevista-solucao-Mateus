<html>

<head>
    <title>Cores</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="icon" href="../icons/icon.png"/>
    <script src="../javascript/functions.js"></script>
</head>

<header class="header">
    <div name="dados" class="dados">
        <i class="child icon fa fa-book" aria-hidden="true"></i>
        <p class="child">Teste de conhecimentos PHP + Banco de dados</p>
    </div>
</header>

<main>

    <div name="body">

        <div class="pageicon">
            <h3>Cores do Usuário</h3>
        </div>

        <table class="table">
            <tr>
                <th>Nome</th>
                <th>Cor</th>
                <th></th>
            </tr>
            <?php
            require '../connection.php';

            $connection = new Connection();

            //PEGAR ID DO USUÁRIO SELECIONAD VIA GET
            $id = $_GET["id"];

            //SELECIONAR TODAS AS CORES QUE O USUÁRIO TEM VINCULADO A SUA CONTA
            $colors_user = $connection->query("SELECT users.id as user_id, colors.id as color_id,users.name as user_name,colors.name as color_name FROM users 
                                              INNER JOIN user_colors ON user_colors.user_id=users.id
                                              INNER JOIN colors ON colors.id = user_colors.color_id
                                              WHERE users.id=$id");
            foreach ($colors_user as $color) {
                echo sprintf("<tr>
                                        <td>%s</td>
                                        <td style='background-color:%s'>%s</td> 
                                        <td><a class='btn btn-outline-danger d-flex justify-content-center' href='_post_processing.php?action=delete_color&id=%s&color=%s' style='text-decoration:none'> Deletar </a></td>
                                    </tr>", $color->user_name, $color->color_name, " ", $color->user_id, $color->color_id);
            }

            //SELECIONA TODAS AS CORES QUE O USUÁRIO NÃO TEM VINCULADO A SUA CONTA
            $colors = $connection->query("SELECT colors.id as id, colors.name as name FROM colors WHERE colors.id NOT IN (SELECT color_id FROM user_colors WHERE user_id=$id)");

            //POR FALTA DE METODO DE CONTAGEM DE LINHAS, FAZER UMA QUERY CONTADORA DE VALORES
            $color_count = $connection->query("SELECT COUNT(*) FROM colors WHERE colors.id NOT IN (SELECT color_id FROM user_colors WHERE user_id=$id)")->fetchColumn(0);

            echo sprintf("<form action='_post_processing.php?action=insert_color' method='post'>
                                <tr>
                                <td></td>
                                <td>
                                    <input type='hidden' name='id' value='$id'/> 
                                    ");

            //CASO AINDA TENHAMOS CORES DISPONÍVEIS, MOSTRAR O SELECT NA ULTIMA LINHA DA TABELA, DANDO AO USUÁRIO A OPORTUNIDADE DE SELECIONAR UMA DELAS
            if ($color_count > 0) {
                echo sprintf("<select name='color' class='form-select'>
                                <option value='0'>--SELECIONE UMA COR-- </option>");
                foreach ($colors as $color) {
                    echo sprintf(
                        "<option value='%s'> %s </option>
                                                ",
                        $color->id,
                        $color->name
                    );
                }
                echo sprintf("      </select>
                                </td>
                                <td>     
                                    <button type='submit' class='btn btn-outline-success'> Adicionar </button>
                                </td>
                            </tr>
                         </form>
                        ");
            }
            ?>
        </table>
    </div>
    <div>
        <a class="form-control form-button return-button-colors text-left" href='../index.php'> RETURN </a>
    </div>
    <div name="footer" class="footer">
        <p> Feito por <a href="https://www.linkedin.com/in/mateus-alves-bittencourt-gaut%C3%A9rio-2b329214a/"><b>Mateus Alves Bittencourt Gautério</b></a> @ Outubro de 2023
        </p>
    </div>
</main>

</html>