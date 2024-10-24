<?php session_start(); ?>

<div class="menu">
    <div class="logo">
        <h1>Votação de Jogos</h1>
    </div>
    <div class="user-options">
        
            <div class="user-icon">
                <img src="../image/user-icon.png" onclick="toggleDropdown()" >
                <div class="dropdown-content" id="myDropdown">
                    <a href="loginadm.php">Login como Desenvolvedor</a>
                    <a href="visitante_logado.php">Login como Visitante</a>
                    <a href="logout.php">Sair</a>
                </div>
            </div>
        <?php if (isset($_SESSION['admin'])): ?>
            <div class="user-icon">
                <img src="../image/user-icon.png" onclick="toggleDropdown()">
                <div class="dropdown-content" id="myDropdown">
                    <a href="visitante_logado.php">Login como Visitante</a>
                    <a href="logout.php">Sair</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}
</script>

<style>
.menu {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    background-color: #333;
    color: white;
}
.logo h1 {
    margin: 0;
}
.user-options {
    display: flex;
    align-items: center;
}
.user-icon img {
    width: 40px;
    height: 40px;
    cursor: pointer;
}
.dropdown-content {
    display: none;
    position: absolute;
    top: 70px;
    right: 20px;
    background-color: #f9f9f9;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
.dropdown-content a:hover {
    background-color: #f1f1f1;
}
.show {
    display: block;
}
</style>
