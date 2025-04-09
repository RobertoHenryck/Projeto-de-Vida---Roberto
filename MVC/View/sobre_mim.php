<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Erro: Usuário não autenticado.");
}

$user_id = $_SESSION['usuario_id'];

// Se o formulário for enviado, salva o texto na tabela 'sobre_mim'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sobre_mim = $_POST['sobre_mim'] ?? '';

    // Salva os dados na tabela 'sobre_mim'
    $sql = "INSERT INTO sobre_mim (user_id, sobre_mim) VALUES (:user_id, :sobre_mim)
            ON DUPLICATE KEY UPDATE sobre_mim = :sobre_mim";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':sobre_mim', $sobre_mim);

    if ($stmt->execute()) {
        // Redireciona para a página de perfil após salvar
        header("Location: perfil.php");
        exit;
    } else {
        $erro = "Erro ao salvar o texto.";
    }
}

// Buscar o texto "Sobre Mim" do usuário
$sql = "SELECT sobre_mim FROM sobre_mim WHERE user_id = :user_id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$sobre_mim_result = $stmt->fetch(PDO::FETCH_ASSOC);
$sobre_mim_atual = $sobre_mim_result ? $sobre_mim_result['sobre_mim'] : ''; // Se não encontrar, define como vazio.
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sobre Mim</title>
</head>
<body>

    <h2>Sobre Mim</h2>

    <!-- Exibe erro se houver -->
    <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

    <!-- Formulário para editar e salvar o texto sobre mim -->
    <form method="POST">
        <label for="sobre_mim">Escreva algo sobre você:</label><br>
        <textarea name="sobre_mim" id="sobre_mim" rows="5" cols="50" required><?= htmlspecialchars($sobre_mim_atual ?? '') ?></textarea><br><br>

        <button type="submit">Salvar</button>
    </form>

    <!-- Exibe a descrição atual se houver -->
    <h3>O que você escreveu sobre você:</h3>
    <p><?= htmlspecialchars($sobre_mim_atual ?? 'Você ainda não escreveu nada sobre si mesmo.') ?></p>

</body>
</html>
