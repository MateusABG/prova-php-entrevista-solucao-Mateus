<?php
require '../connection.php';

$connection = new Connection();

$action = str_replace("'", "", $_GET["action"]);


switch ($action) {
    case "insert_usuario":
        $nome = $_POST["name"];
        $email = $_POST["email"];

        //Insere dados ao banco de dados de usuarios
        if (!empty($nome) || !empty($email)) {
            $insert = $connection->query("INSERT INTO users(name,email) VALUES('$nome','$email')");
            header("Location: ../index.php");
        } else {
            header("Location: inserir_usuario.php?error='msg'");
        }
        break;

    case "insert_color":
        $user_id = $_POST['id'];
        $color = $_POST["color"]; 
        if ($color != 0) {
            //Insere dados ao banco de dados de usuarios
            $connection->query("INSERT INTO user_colors(user_id,color_id) VALUES($user_id,$color)");
        }
        header("Location: cores.php?id=$user_id");
        break;

    case "delete_color":
        $user_id = $_GET['id'];
        $color = $_GET["color"];
        //Insere dados ao banco de dados de usuarios
        $connection->query("DELETE FROM user_colors WHERE user_id = $user_id AND color_id=$color");
        header("Location: cores.php?id=$user_id");
        break;

    case "editar_usuario":
        $nome = $_POST["name"];
        $email = $_POST["email"];
        $id = $_POST['id'];
        $connection->query("UPDATE users SET name='$nome', email='$email' WHERE id = $id");
        header("Location: ../index.php");
        break;

    case "delete_usuario":
        $id = $_GET['id'];
        $connection->query("DELETE FROM users WHERE id=$id");
        $connection->query("DELETE FROM user_colors WHERE user_id=$id");
        header("Location: ../index.php");
        break;
}