function popUpConfirm(user_name, user_id) {
    if (window.confirm("Gostaria de deletar o usuário " + user_name + "?")) {
        location.href = 'pages/_post_processing.php?action=delete_usuario&id=' + user_id;
    }
}

function closeMsg(user_name, user_id) {
    document.getElementById('msg').style.display="none";
}