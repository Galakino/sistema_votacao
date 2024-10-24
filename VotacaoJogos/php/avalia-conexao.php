<?php
session_start();
include 'db.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jogoId = intval($_POST['jogoId']);
    $voto = $_POST['tipo']; // "like" ou "dislike"
    $comentario = mysqli_real_escape_string($conn, $_POST['avaliacao']);
    $usuarioId = $_SESSION['user_id']; // ID do usuário logado

    // Verificar se o comentário não está vazio
    if (!empty($comentario)) {
        // Insere a avaliação no banco de dados
        $query = "INSERT INTO avaliacoes (id_usuario, id_jogo, voto, comentario) VALUES ('$usuarioId', '$jogoId', '$voto', '$comentario')";
        
        if (mysqli_query($conn, $query)) {
            // Redireciona de volta para a página principal
            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao registrar avaliação: " . mysqli_error($conn);
        }
    } else {
        echo "O comentário não pode estar vazio.";
    }
}
?>

