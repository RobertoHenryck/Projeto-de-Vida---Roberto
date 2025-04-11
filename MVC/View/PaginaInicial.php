<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_nome'])) {
    header('Location: index.php');
    exit;
}

// Obter os dados do usuário logado
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nome, foto_perfil, data_nascimento FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);


$foto_perfil = !empty($usuario['foto_perfil']) ? 'users/' . $usuario['foto_perfil'] : 'users/foto_padrao.png';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View/css/Página_Inicial.css">
    <title>Dashboard Principal</title>
</head>
<body>
    <style>
        .form-sair button {
    padding: 8px 16px;
    background-color: #0e0090;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.form-sair button:hover {
    background-color:rgb(99, 85, 224);
}

    </style>
    


<header>
    <h1 class="titulo">Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h1>
    <div class="header-direita">
        <img class="foto-perfil" src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil">
        <form action="logout.php" method="POST" class="form-sair">
            <button type="submit">Sair</button>
        </form>
    </div>
</header>



<main>









</main>



<footer>
    <p>&copy; 2025 Roberto. Todos os direitos reservados.</p>
</footer>

</body>
</html>
