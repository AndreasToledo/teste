<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_V = $_POST['password_V'];

    if ($password === $password_V) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT); //cria um hash em formato padrão para sua senha
        $stmt = $pdo->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)"); //prepara entrada de dados no BD
        
        if ($stmt->execute([$name, $email, $password])) { //manda os dados para o BD e os registra
            header("Location: login.php");
            exit();
        } else {
            $erro = "Erro no cadastro, tente novamente.";
        }
    } else {
        $erro = "A senha está incorreta.";
    }
}
?>

<!doctype html>
<html>
    <head>
        <title>Cadastro</title>
    </head>
        <body>
        <h2>Cadastro</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Nome" required><br><br>
            <input type="email" name="email" placeholder="E-mail" required><br><br>
            <input type="password" name="password" placeholder="Senha" required><br><br>
            <input type="password" name="password_V" placeholder="Confirme a Senha" required><br><br>
            <button type="submit">Cadastrar</button><br><br>
        </form>
        <a href="login.html">Seguir para Login</a>
    </body>
</html>