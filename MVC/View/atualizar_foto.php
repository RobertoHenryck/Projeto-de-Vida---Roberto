<?php
session_start();
require_once 'C:\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $usuario_id = $_SESSION['usuario_id']; // ID do usuário logado
    $diretorio = 'users/'; // Pasta onde as fotos serão salvas

    // Criar a pasta se não existir
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    // Criar um nome único para a imagem
    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto_nome = 'perfil_' . $usuario_id . '.' . $extensao;
    $destino = $diretorio . $foto_nome;

    // Tentar mover a foto para a pasta correta
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
        // Atualizar o caminho da foto no banco de dados
        $sql = "UPDATE users SET foto_perfil = :foto WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':foto', $foto_nome);
        $stmt->bindParam(':id', $usuario_id);

        if ($stmt->execute()) {
            $_SESSION['foto_perfil'] = $foto_nome; // Atualiza a sessão para exibir a nova foto
            header('Location: perfil.php'); // Redireciona para o perfil
            exit;
        } else {
            echo "Erro ao salvar no banco!";
        }
    } else {
        echo "Erro ao mover a imagem!";
    }
}

?>
