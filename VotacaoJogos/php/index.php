<?php
include 'db.php';
include 'menu.php';
// Verifique se o usuário está logado como administrador ou visitante
$admin_logado = isset($_SESSION['admin']);
$visitante_logado = isset($_SESSION['visitante']);


// Processar a avaliação se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['avaliacao'])) {
   if(isset($_SESSION['visitante'])){
    
        $id_usuario =  $_SESSION['visitante_id'];
        $id_jogo = intval($_POST['jogoId']);        
        $voto = $_POST['tipo'];
        $comentario = mysqli_real_escape_string($conn, $_POST['avaliacao']);
       
       // Verificar se o comentário não está vazio
       if (!empty($comentario)) {
           // Consulta para inserir a avaliação usando prepared statement
           $stmt = $conn->prepare("INSERT INTO avaliacoes (id_usuario, id_jogo, voto, comentario) VALUES (?, ?, ?, ?)");
           $stmt->bind_param('iiss', $id_usuario, $id_jogo, $voto, $comentario);
           
           if ($stmt->execute()) {
               header("Location: index.php"); // Redireciona para a mesma página
               exit;
           } else {
               echo "Erro ao registrar avaliação: " . $stmt->error;
           }
           $stmt->close();
       } else {
           echo "O comentário não pode ser vazio.";
       }        
   } else {
        echo "Dados inválidos";
   }
   
}

// Consultar os jogos e suas avaliações
$sql = "SELECT j.*, 
        (SELECT COUNT(*) FROM avaliacoes a WHERE a.id_jogo = j.id AND a.voto = 'like') AS total_likes, 
        (SELECT COUNT(*) FROM avaliacoes a WHERE a.id_jogo = j.id AND a.voto = 'dislike') AS total_dislikes 
        FROM jogos j";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Votação de Jogos</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<style>
    /* Adicione seus estilos CSS aqui */
    body {
        font-family: Arial, sans-serif;
        background-image: url("OIP (1).jfif");
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        text-align: center;
    }
    .ver{
        text-align: center;
        Color: red;
    }
    .jogo {
        margin: 20px 0;
        border-bottom: 1px solid #ccc;
        padding-bottom: 20px;
    }

    .avaliacao1 {
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .avaliacao1:hover {
        background-color: #0056b3;
    }

    .avaliacoes {
        margin-top: 10px;
    }

    .avaliacao {
        margin: 5px 0;
    }

    .avaliacao-form {
        margin-top: 20px;
    }

    .button-container {
        margin: 10px 0;
    }
    .popup {
            display: none;
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .show {
            display: block;
        }

        .popup1 {
            display: none;
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #e81212;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .show {
            display: block;
        }
</style>
<body>    
    <?php
        if (!empty($_SESSION['admin'])) {
            // Destrua a sessão do visitante ao logar como administrador
            unset($_SESSION['visitante']); // Remove a variável do visitante da sessão

            echo '<h1>Bem vindo, ' . $_SESSION['admin'] . '!'. '<br> Ao sistema de cadastramento de jogos</br></h1>';
            echo "<p class = 'ver'>Para visualizar os jogos cadastrados é preciso sair da sua conta de desenvolvedor e entrar com a sua conta de visitante!</p>";
        } 

        // Verifique se o visitante está logado
        if (!empty($_SESSION['visitante'])) {
            echo '<h1>Bem vindo, ' . $_SESSION['visitante'] . '!'. '<br> Ao sistema de votação de jogos</br></h1>';
        } 
    ?>
    <div class="popup" id="popup-message1">
        Avaliação excluida com sucesso.
    </div>
<div class="container">
    <?php if ($admin_logado): ?>
        <!-- Formulário para o desenvolvedor adicionar um novo jogo -->
        <h2>Cadastrar Novo Jogo</h2>
        <form action="cadastrar_jogo.php" method="post" enctype="multipart/form-data">
            <label for="nome">Nome do Jogo:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" required></textarea><br><br>

            <label for="imagem1">Imagem 1:</label>
            <input type="file" id="imagem1" name="imagem1" accept="image/*" required><br><br>

            <label for="imagem2">Imagem 2:</label>
            <input type="file" id="imagem2" name="imagem2" accept="image/*" required><br><br>

            <input type="submit" value="Cadastrar Jogo">
        </form>
    <?php elseif ($visitante_logado): ?>
        <!-- Lista de Jogos para visitantes -->
        <h2>Lista de Jogos</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='jogo'>";
                echo "<h3>" . htmlspecialchars($row['nome']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['descricao']) . "</p>";
                echo "<img src='" . htmlspecialchars($row['imagem1']) . "' alt='Imagem do Jogo' style='width:200px; height:200px;'> ".
                     "<img src='" . htmlspecialchars($row['imagem2']) . "' alt='Imagem do Jogo' style='width:200px; height:200px;'><br><br>";
                
                // Exibe o total de likes e dislikes
                echo "<p>Likes: " . $row['total_likes'] . " | Dislikes: " . $row['total_dislikes'] . "</p>";

                // Formulário para avaliação
                echo "<form action='index.php' method='POST'>
                        <input type='hidden' name='jogoId' value='" . $row['id'] . "'>
                        <input type='radio' name='tipo' value='like' required> Like
                        <input type='radio' name='tipo' value='dislike' required> Dislike
                        <br>
                        <textarea style='resize:none;' name='avaliacao' required placeholder='Digite sua avaliação...'></textarea>
                        <br>
                        <input type='submit' class = 'avaliacao1' value='Enviar Avaliação'>
                      </form>";

                // Exibe as avaliações
            echo "<h4>Avaliações:</h4>";
                $jogoId = $row['id'];

                // Usando prepared statement para evitar SQL injection
                $queryAvaliacoes = "SELECT a.id, a.comentario, a.voto, a.id_usuario, u.nome AS usuario_nome 
                                    FROM avaliacoes a 
                                    JOIN usuarios u ON a.id_usuario = u.id 
                                    WHERE a.id_jogo = ?";

                $stmt = $conn->prepare($queryAvaliacoes);
                $stmt->bind_param('i', $jogoId);
                $stmt->execute();
                $resultadoAvaliacoes = $stmt->get_result();

                if ($resultadoAvaliacoes->num_rows > 0) {
                    while ($avaliacao = $resultadoAvaliacoes->fetch_assoc()) {
                        echo "<div class='avaliacao'>";
                        echo "<strong>" . htmlspecialchars($avaliacao['usuario_nome']) . "</strong> "; 
                        echo "(" . htmlspecialchars($avaliacao['voto']) . "): ";
                        echo htmlspecialchars($avaliacao['comentario']);
                        
                        // Verifica se o usuário logado é o autor da avaliação
                        if ($_SESSION['visitante_id'] == $avaliacao['id_usuario']) {
                            echo "<form action='exclui_avaliacao.php' method='POST'>
                                <input type='hidden' name='exclui' value='" . htmlspecialchars($avaliacao['id']) . "'>
                                <button type='submit' class='exclui'>Excluir</button>
                                </form>";
                        }
                        echo "</div>";
                    }
                } else {
                    echo "<p>Nenhuma avaliação ainda.</p>";
                }
                }
            } else {
                echo "Nenhum jogo cadastrado.";
            }
        ?>
    <?php else: ?>
        <p>Você precisa estar logado para ver as avaliações dos jogos.</p>
    <?php endif; ?>
</div>

<script>
// Verifica se o parâmetro 'cadastro_sucesso' existe na URL
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('avaliacao_sucesso')) {
    document.getElementById('popup-message1').classList.add('show');
    setTimeout(() => {
        document.getElementById('popup-message1').classList.remove('show');
    }, 2000);
} 

</script>
</body>
</html>
