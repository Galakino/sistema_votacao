<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $senhaCriptografada = hash('sha256', $senha);

    $query = "SELECT * FROM adm WHERE username = '$username' AND senha = '$senhaCriptografada'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Login error
        echo "Usuário ou senha incorretos.";
    }
}
?>

