<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['senha'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    
        // Criptografa a senha com SHA-256
        $senhaCriptografada = hash('sha256', $senha);
    
        // Insere o novo usuário administrador no banco de dados
        $query = "INSERT INTO adm (username, senha) VALUES ('$username', '$senhaCriptografada')";
        $resultado = mysqli_query($conn, $query);
        
        if ($resultado) {
          header("Location: loginadm.php?cadastro_sucesso=1");
        } else {
            echo "Erro ao inserir o usuário: " . mysqli_error($conn);
        }
        
        // Fecha a conexão corretamente
        $conn->close();
    } else {
        echo "Index indefinido";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Administrador</title>
</head>
<style>
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
  background-color: #db550c;
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
<body>
<p>
 Logar adm <a href="loginadm.php">Logar adm</a>
</p>
<form action="cadastro-adm.php" method="post" class="form">
       <p class="form-title">Cadastro adm</p>
        <div class="input-container">
          <input type="text" id="username" name="username" placeholder="Digite um nome" required>
          <span>
          </span>
      </div>
      <div class="input-container">
          <input type="password" id="senha" name="senha" placeholder="Digite uma senha" required>
        </div>
         <button type="submit" class="submit">
        Cadastrar
      </button>
   </form>

</body>
</html>
