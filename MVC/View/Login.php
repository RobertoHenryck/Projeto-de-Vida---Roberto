<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        if (password_verify($senha, $usuario['senha'])) {

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            
            header('Location:PáginaInicial.php');
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
     
    </style>
    <script>
        window.onload = function() {
            alert("Para continuar, faça login.");
        }
    </script>
</head>

<body>

    <div class="conteudo">
        <div class="logo">
            <h2>
                Faça login no nosso site para acessar o conteúdo exclusivo!
            </h2>
            <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="Logo">
        </div>

        <div class="inputs">
            <form method="POST">
                <h1>LOGIN</h1>
                <p>E-mail</p>
                <input type="email" name="email" placeholder="Email" required>
                <p>Senha</p>
                <input type="password" name="senha" placeholder="Senha" required>
                <div class="botao">
                    <button type="submit">Entrar</button>
                </div>
                <div class="botoes">
                    <p><a href="CadastrarUsuario.php">Não tem uma conta? Cadastre-se aqui</a></p>
                </div>

            </form>
        </div>

    </div>
    </div>


    <?php if (isset($erro)) echo $erro; ?>
</body>

</html>