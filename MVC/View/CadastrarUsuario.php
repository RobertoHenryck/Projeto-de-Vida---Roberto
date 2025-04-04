<?php
session_start();

require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $senha = $_POST['senha'];
    
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }

    // Verificar se o email já está cadastrado
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $erro = "Este email já está cadastrado!";
    } else {
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir usuário no banco de dados (REMOVIDO O 'tipo')
        $sql = "INSERT INTO users (nome, email, data_nascimento, senha) 
                VALUES (:nome, :email, :data_nascimento, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':senha', $senha_criptografada);

        if ($stmt->execute()) {
            $_SESSION['usuario_nome'] = $nome;
            $_SESSION['usuario_email'] = $email;
            $_SESSION['data_nascimento'] = $data_nascimento;
            $_SESSION['senha'] = $senha_criptografada;

            header('Location: index.php');
            exit;
        } else {
            $erro = "Erro ao cadastrar o usuário. Tente novamente!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="date" name="data_nascimento" placeholder="Data de Nascimento" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <input type="submit" value="Cadastrar"><br>
</form>

</body>
</html>
