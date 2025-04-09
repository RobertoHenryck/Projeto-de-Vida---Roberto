<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    die("Erro: Usuário não autenticado.");
}

$user_id = $_SESSION['usuario_id'];

// Definir as áreas do plano de ação
$areas = ['Relacionamento Familiar', 'Estudos', 'Saúde', 'Futura Profissão', 'Religião', 'Amigos', 'Namorado(a)', 'Comunidade', 'Tempo Livre'];

// Buscar os dados do plano de ação do usuário
$planos_acao = [];

foreach ($areas as $area) {
    $area_underscore = str_replace(' ', '_', $area); // Substituindo espaços por underscores
    $sql = "SELECT descricao, prazo, passo1, passo2, passo3 FROM plano_acao WHERE user_id = :user_id AND area = :area";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':area', $area);
    $stmt->execute();
    $planos_acao[$area_underscore] = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Plano de Ação</title>
</head>
<body>

    <h1>Resultado do Plano de Ação</h1>

    <?php foreach ($areas as $area): ?>
        <?php
            // Substituindo espaços por underscores para criar a chave do array
            $area_underscore = str_replace(' ', '_', $area);
            // Pegando os dados do plano de ação para esta área
            $plano = $planos_acao[$area_underscore] ?? null;
        ?>

        <h2><?php echo htmlspecialchars($area); ?></h2>
        
        <?php if ($plano): ?>
            <table border="1">
                <tr>
                    <th>Descrição</th>
                    <th>Prazo</th>
                    <th>Passo 1</th>
                    <th>Passo 2</th>
                    <th>Passo 3</th>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars($plano['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($plano['prazo']); ?></td>
                    <td><?php echo htmlspecialchars($plano['passo1']); ?></td>
                    <td><?php echo htmlspecialchars($plano['passo2']); ?></td>
                    <td><?php echo htmlspecialchars($plano['passo3']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Você ainda não preencheu um plano de ação para esta área.</p>
        <?php endif; ?>

        <hr>
    <?php endforeach; ?>

</body>
</html>
