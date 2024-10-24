<?php
session_start();
include 'db.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

    // Diretório onde as imagens serão salvas
    $targetDir = "uploads/";
    
    // Verifica se o diretório existe, se não, cria
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $imagem1 = $_FILES['imagem1'];
    $imagem2 = $_FILES['imagem2'];

    // Gerando nomes de arquivos únicos
    $targetFile1 = $targetDir . basename($imagem1['name']);
    $targetFile2 = $targetDir . basename($imagem2['name']);

    // Verifica se houve erro no upload
    if ($imagem1['error'] === UPLOAD_ERR_OK && $imagem2['error'] === UPLOAD_ERR_OK) {
        // Move os arquivos para o diretório alvo
        if (move_uploaded_file($imagem1['tmp_name'], $targetFile1)) {
            if (move_uploaded_file($imagem2['tmp_name'], $targetFile2)) {
                // Ambos os arquivos foram movidos com sucesso
                $query = "INSERT INTO jogos (nome, descricao, imagem1, imagem2) VALUES ('$nome', '$descricao', '$targetFile1', '$targetFile2')";
                mysqli_query($conn, $query);
                
                // Exibe a mensagem de sucesso
                echo "<p>Jogo cadastrado com sucesso!</p>";
                
                // Adiciona o JavaScript para redirecionar após 3 segundos
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 3000); // 3 segundos
                      </script>";
            }
             else {
                echo "Erro ao mover o segundo arquivo: " . $imagem2['error'];
            }
        } else {
            echo "Erro ao mover o primeiro arquivo: " . $imagem1['error'];
        }
    } else {
        echo "Erro no upload do arquivo: ";
        if ($imagem1['error'] !== UPLOAD_ERR_OK) {
            echo "Imagem 1: " . $imagem1['error'] . " ";
        }
        if ($imagem2['error'] !== UPLOAD_ERR_OK) {
            echo "Imagem 2: " . $imagem2['error'];
        }
    }
}
?>
