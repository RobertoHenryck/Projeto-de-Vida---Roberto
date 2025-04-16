<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

if (!isset($_SESSION['usuario_id'])) {
    die("Erro: Usuário não autenticado.");
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT nome, foto_perfil, sobre_mim FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);


$foto_perfil = !empty($usuario['foto_perfil']) ? 'users/' . $usuario['foto_perfil'] : 'users/foto_padrao.png';


$sobre_mim_atual = $usuario['sobre_mim'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="../View/css/perfil.css">
<style>
    button,
    input {
        width: 100%;
        padding: 10px;
        background-color: #7e7e86;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: 7e7e86;
        font-size: 20px;
        transition: 0.9s;
    }

    .inputfile {
        display: none;
    }

    .custom-file-upload {
        display: inline-block;
        padding: 10px 20px;
        background-color: #7e7e86;  
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        font-family: sans-serif;
        transition: background 0.3s ease;
    }

    .custom-file-upload:hover {
        background-color: #e06620;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>

</head>

<body>

    <header>
        <h1>Perfil</h1>
        <div class="header-direita">
            <form action="logout.php" method="POST" class="form-sair">
                <button type="submit">Sair</button>
            </form>
        </div>
    </header>
    <main>
        <container>
            <div class="perfil">
                <div class="foto_perfil">
                    <h1 class="nome"><?= htmlspecialchars($usuario['nome']) ?></h1>
                    <img src="<?= htmlspecialchars($foto_perfil) ?>" alt="Foto de Perfil" width="150"><br>
                    <br>
                    <form action="atualizar_foto.php" method="POST" enctype="multipart/form-data">

                        <input type="file" name="foto" class="inputfile" required>
                        <label for="arquivo" class="custom-file-upload">Escolher arquivo</label>
                        <br>
                        <br>
                        <button type="submit">Atualizar Foto</button>
                </div>
                </form>
            </div>


            <hr>

            <div class="sobre_mim">
                <h2>Sobre você</h2>
                <?= nl2br(htmlspecialchars($sobre_mim_atual ?: 'Você ainda não escreveu nada sobre si mesmo.')) ?>
            </div>




        </container>
    </main>
    <section>
        <div class="links">

            <a href="teste_personalidade.php">Teste de Personalidade</a>
            <a href="teste_inteligencia.php">Teste de Inteligência</a>
            <a href="quem_sou.php">Quem sou?</a>
            <a href="sobre_mim.php">Escreva sobre você</a>
            <a href="planejamento_futuro.php">Planejamento do Futuro</a>
        </div>
    </section>
</body>

</html>