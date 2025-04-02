<?php
session_start();
require_once 'C:\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Buscar os dados do usuário logado
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nome, foto_perfil FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir a foto de perfil
$foto_perfil = !empty($usuario['foto_perfil']) ? 'users/' . $usuario['foto_perfil'] : 'users/foto_padrao.png';
?>

<h1>BEM VINDO, <?php echo htmlspecialchars($usuario['nome']); ?></h1>

<img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil" width="150">

<form action="atualizar_foto.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="foto" required>
    <button type="submit">Atualizar Foto</button>
</form>
