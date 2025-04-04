<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $usuario_id = $_SESSION['usuario_id']; // ID do usuário logado
    $diretorio = 'users/'; // Pasta onde as fotos serão salvas

    // Cria a pasta se não existir
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $arquivo = $_FILES['foto'];
    $nome_arquivo = $arquivo['name'];
    $tmp = $arquivo['tmp_name'];
    $erro = $arquivo['error'];
    $tamanho = $arquivo['size'];
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $tamanho_maximo = 2 * 1024 * 1024; // 2MB

    // Validações
    if ($erro !== 0) {
        die("Erro ao enviar o arquivo.");
    }
    if (!in_array($extensao, $extensoes_permitidas)) {
        die("Tipo de arquivo não permitido. Envie JPG, PNG, GIF ou WEBP.");
    }
    if ($tamanho > $tamanho_maximo) {
        die("Arquivo muito grande. Máximo permitido: 2MB.");
    }

    // Gera nome único para a imagem
    $foto_nome = 'perfil_' . $usuario_id . '_' . time() . '.' . $extensao;
    $destino = $diretorio . $foto_nome;

    // Tenta mover a imagem para o diretório correto
    if (move_uploaded_file($tmp, $destino)) {
        // Atualiza o caminho da foto no banco de dados
        $sql = "UPDATE users SET foto_perfil = :foto WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':foto', $foto_nome);
        $stmt->bindParam(':id', $usuario_id);

        if ($stmt->execute()) {
            $_SESSION['foto_perfil'] = $foto_nome; // Atualiza a sessão
            header('Location: perfil.php'); // Redireciona para o perfil
            exit;
        } else {
            echo "Erro ao atualizar o banco de dados!";
        }
    } else {
        echo "Erro ao mover o arquivo!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Foto de Perfil</title>
</head>
<body>
    <h2>Atualizar Foto de Perfil</h2>
    <!-- Formulário para upload de imagem -->
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="foto" accept="image/*" required>
        <button type="submit">Atualizar Foto</button>
    </form>
</body>
</html>
