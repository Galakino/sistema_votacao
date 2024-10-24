<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = mysqli_real_escape_string($conn, $_POST['username']);  // Corrigido o campo de nome de 'nome' para 'username'
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    
    // Criptografando a senha com SHA256
    $senhaCriptografada = hash('sha256', $senha);

    // Inserindo visitante no banco de dados
    $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaCriptografada')";
    if (mysqli_query($conn, $query)) {
        header("Location: visitante_logado.php?cadastro_sucesso=1");
        exit();  
    } else {
        echo "Erro ao cadastrar visitante.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Visitante</title>
    <style>
        body {
            background-image: url('../image/fundo1.jpg');
            background-size: cover; /* Ajusta a imagem para cobrir todo o fundo */
            background-position: center; /* Centraliza a imagem */
            background-repeat: no-repeat; /* Evita que a imagem se repita */
            background-attachment: fixed; /* A imagem permanece fixa ao rolar a página */
        }
        .form {
            background-color: #fff;
            display: block;
            padding: 1rem;
            max-width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 600;
            text-align: center;
            color: #000;
        }

        .input-container {
            position: relative;
        }

        .input-container input, .form button {
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
        }

        .input-container input {
            background-color: #fff;
            padding: 1rem;
            padding-right: 3rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 300px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .submit {
            display: block;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            background-color: #4F46E5;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            border-radius: 0.5rem;
            text-transform: uppercase;
        }

        .signup-link {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
            text-align: center;
        }

        .signup-link a {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form action="cadastrar_visitante.php" method="post" class="form">
  <center>
       <h3 class="form-title">Cadastrar como Visitante</h3>
        <div class="input-container">
          <input type="text" name="username" placeholder="Seu nome aqui" required>
      </div>
      <div class="input-container">
          <input type="email" name="email" placeholder="Seu email aqui" required>
      </div>

      <div class="input-container">
          <input type="password" name="senha" placeholder="Sua senha aqui" required>
      </div>
         <button type="submit" class="submit">
        Cadastrar
        </button>
        <p>
          Já possui cadastro? <a href="visitante_logado.php">Logar</a>
        </p>
  </center>
</form>
</body>
</html>
