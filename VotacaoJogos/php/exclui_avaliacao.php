<?php
session_start();
include 'db.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_avaliacao = mysqli_real_escape_string($conn, $_POST['exclui']);
    $id_usuario_logado = $_SESSION['visitante_id'];

    $sql = "DELETE FROM avaliacoes WHERE id = ? AND id_usuario = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $id_avaliacao, $id_usuario_logado);
    
    if ($stmt->execute()) {
        // Verifica se alguma linha foi afetada (ou seja, se a avaliação foi realmente deletada)
        if ($stmt->affected_rows > 0) {
            // Avaliação foi excluída com sucesso, redireciona de volta para o index
            header("Location: index.php?avaliacao_sucesso=1");
            exit();
        } 
    } else {
        // Caso ocorra algum erro na execução da consulta
        echo "Erro ao tentar excluir a avaliação: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
