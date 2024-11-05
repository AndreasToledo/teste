<?php

session_start();
require 'db.php'; 

if (!isset($_SESSION['user_id'])) { //Se o ID criado na sessão não existir, mostra uma opção para voltar ao login
    echo "Acesso negado. <a href='login.php'>Voltar ao login</a>";
    session_destroy();
    exit();

    if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) { //Se o IP da sessão for diferente do IP da máquina, destrói a sessão
        session_destroy();
        echo "Acesso negado, desconectando. <a href='login.php'>Voltar ao login</a>";
        exit();
    }
}



$stmt = $pdo->prepare("SELECT name, email FROM user WHERE id = ?"); //Traz o dados do banco que serão chamados logo abaixo
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

?>

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Conteúdo</title>
    </head>
    <body>
        <h2>Bem-vindo, <?php echo $user['name']; ?>!</h2>
            <p>O seu email registrado é <?php echo $user['email']; ?>, denada!</p> <!-- Exibição do email, chamando do banco de dados -->
        <a href="logout.php">Sair</a>
    </body>
</html>