<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Erro: Usuário não autenticado.");
}

$usuario_id = $_SESSION['usuario_id'];

// Buscar dados do usuário logado
$sql = "SELECT nome, foto_perfil, sobre_mim FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Foto de perfil
$foto_perfil = !empty($usuario['foto_perfil']) ? 'users/' . $usuario['foto_perfil'] : 'users/foto_padrao.png';

// Texto atual "Sobre Mim"
$sobre_mim_atual = $usuario['sobre_mim'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    
</head>
<body>

    <h1>BEM-VINDO, <?= htmlspecialchars($usuario['nome']) ?></h1>

    <!-- Foto de Perfil -->
    <img src="<?= htmlspecialchars($foto_perfil) ?>" alt="Foto de Perfil" width="150"><br>

    <!-- Atualizar Foto -->
    <form action="atualizar_foto.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="foto" required>
        <button type="submit">Atualizar Foto</button>
    </form>

    <!-- Logout -->
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>

    <!-- Links úteis -->
    <a href="teste_personalidade.php">Teste de Personalidade</a> |
    <a href="teste_inteligencia.php">Teste de Inteligência</a> |
    <a href="quem_sou.php">Quem sou?</a> |
    <a href="sobre_mim.php">Escreva sobre você</a>
    <a href="planejamento_futuro.php">Planejamento do Futuro</a>

   

    <h2>Sobre Mim</h2>
    <div class="sobre-mim">
        <?= nl2br(htmlspecialchars($sobre_mim_atual ?: 'Você ainda não escreveu nada sobre si mesmo.')) ?>
    </div>

</body>
</html>
