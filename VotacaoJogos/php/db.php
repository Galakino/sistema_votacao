<?php
$host = "localhost"; 
$user = "root";      
$senha = "root";          
$db = "sistema_votacao";  

$conn = new mysqli($host, $user, $senha, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
