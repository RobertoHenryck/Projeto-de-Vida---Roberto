<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Erro: Usuário não autenticado.");
}

$usuario_id = $_SESSION['usuario_id'];

// Buscar os dados do usuário logado (nome e foto)
$sql = "SELECT nome, foto_perfil FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir a foto de perfil
$foto_perfil = !empty($usuario['foto_perfil']) ? 'users/' . $usuario['foto_perfil'] : 'users/foto_padrao.png';

// Buscar o texto "Sobre Mim" do usuário
$sql_sobre_mim = "SELECT sobre_mim FROM sobre_mim WHERE user_id = :user_id LIMIT 1";
$stmt_sobre_mim = $pdo->prepare($sql_sobre_mim);
$stmt_sobre_mim->bindParam(':user_id', $usuario_id);
$stmt_sobre_mim->execute();
$sobre_mim_result = $stmt_sobre_mim->fetch(PDO::FETCH_ASSOC);
$sobre_mim_atual = $sobre_mim_result ? $sobre_mim_result['sobre_mim'] : ''; // Se não encontrar, define como vazio.
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
</head>
<body>

    <h1>BEM VINDO, <?php echo htmlspecialchars($usuario['nome']); ?></h1>

    <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil" width="150">

    <form action="atualizar_foto.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="foto" required>
        <button type="submit">Atualizar Foto</button>
    </form>

    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>

    <a href="teste_personalidade.php">Teste de Personalidade</a>
    <a href="teste_inteligencia.php">Teste de Inteligência</a>
    <a href="sobre_mim.php">Sobre Mim</a>
    <a href="quem_sou.php">Quem sou?</a>
    <a href="planejamento_futuro.php">Planejamento do Futuro</a>

    <h2>Sobre mim</h2>
    <p><?php echo htmlspecialchars($sobre_mim_atual ? $sobre_mim_atual : 'Você ainda não escreveu nada sobre si mesmo.'); ?></p>

</body>     
</html>
