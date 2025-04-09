<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\MVC\Controller\Controller.php';

if (!isset($_SESSION['usuario_id'])) {
    die("Erro: Usuário não autenticado.");
}

$user_id = $_SESSION['usuario_id'];
$Controller = new Controller($pdo);

// Processar envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sobre_mim = $_POST['sobre_mim'] ?? '';

    $resultado = $Controller->sobre_mim($user_id, $sobre_mim);

    if ($resultado) {
        header("Location: perfil.php");
        exit;
    } else {
        echo "Erro ao salvar o texto.";
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sobre Mim</title>
</head>
<body>

    <h2>Sobre Mim</h2>

    <form method="POST">
        <label for="sobre_mim">Escreva algo sobre você:</label><br>
        <textarea name="sobre_mim" id="sobre_mim" rows="5" cols="50" required><?= htmlspecialchars($sobre_mim_atual ?? '') ?></textarea><br><br>

        <button type="submit">Salvar</button>
    </form>

</body>
</html>
