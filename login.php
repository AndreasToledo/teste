<?php

session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && $usuario['email'] = $email && $usuario['senha'] = $senha) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
        
        $cookie_name = "user_ip";
        $cookie_value = $_SERVER['REMOTE_ADDR']; //'REMOTE_ADDR' é o IP
        $cookie_duration = time() + (3600 * 1);
        setcookie($cookie_name, $cookie_value, $cookie_duration, "/");
        header("Location: content.php");
        exit();
    } else {
        $erro = "Email ou senha incorretos!";
    }
}

?>

<!doctype html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="E-mail" required><br><br>
            <input type="password" name="senha" placeholder="Senha" required><br><br>
            <button type="submit">Entrar</button><br><br>
        </form>
        <a href="cadastro.php">Cadastrar</a>
    </body>
</html>