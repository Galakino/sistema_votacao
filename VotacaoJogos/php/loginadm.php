<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
</head>
<style>
          body {
            background-image: url('../image/fundoadm.jpg');
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
</style>
<body>
<p>
  Cadastrar adm <a href="cadastro-adm.php">Cadastrar adm</a>
</p>
<div class="popup" id="popup-message">
    Cadastro realizado com sucesso! Faça login.
</div>
<form action="adm-conexao.php" method="post" class="form">
       <p class="form-title">Entre com a sua conta</p>
        <div class="input-container">
          <input type="text" id="username" name="username" placeholder="Enter username" required>
          <span>
          </span>
      </div>
      <div class="input-container">
          <input type="password" id="senha" name="senha" placeholder="Enter password" required>
        </div>
         <button type="submit" class="submit">
        Entrar
      </button>
   </form>
   <script>
    // Verifica se o parâmetro 'cadastro_sucesso' existe na URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('cadastro_sucesso')) {
        // Mostra o popup por 3 segundos
        document.getElementById('popup-message').classList.add('show');
        setTimeout(() => {
            document.getElementById('popup-message').classList.remove('show');
        }, 3000);
    }
</script>
</body>
</html>
