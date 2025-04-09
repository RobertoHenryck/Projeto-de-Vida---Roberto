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

// Função para salvar ou atualizar o plano de ação
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($areas as $area) {
        // Substituindo os espaços por underscores para criar a chave do array
        $area_underscore = str_replace(' ', '_', $area);
        
        // Verificar se os campos foram preenchidos corretamente
        $descricao = $_POST["descricao_$area_underscore"] ?? null;
        $prazo = $_POST["prazo_$area_underscore"] ?? null;
        $passo1 = $_POST["passo1_$area_underscore"] ?? null;
        $passo2 = $_POST["passo2_$area_underscore"] ?? null;
        $passo3 = $_POST["passo3_$area_underscore"] ?? null;

        // Verificar se os campos obrigatórios não estão vazios
        if (!$descricao || !$prazo || !$passo1 || !$passo2 || !$passo3) {
            // Exibir mensagem de erro e não processar o formulário
            echo "Todos os campos devem ser preenchidos!";
            continue;
        }

        // Verificar se já existe um plano para esta área
        $sql = "SELECT id FROM plano_acao WHERE user_id = :user_id AND area = :area";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':area', $area);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            // Atualizar o plano de ação
            $sql = "UPDATE plano_acao SET descricao = :descricao, prazo = :prazo, 
                    passo1 = :passo1, passo2 = :passo2, passo3 = :passo3, 
                    update_at = current_timestamp() WHERE user_id = :user_id AND area = :area";
        } else {
            // Inserir um novo plano de ação
            $sql = "INSERT INTO plano_acao (user_id, area, descricao, prazo, 
                    passo1, passo2, passo3, created_at, update_at) 
                    VALUES (:user_id, :area, :descricao, :prazo, :passo1, :passo2, :passo3, current_timestamp(), current_timestamp())";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':prazo', $prazo);
        $stmt->bindParam(':passo1', $passo1);
        $stmt->bindParam(':passo2', $passo2);
        $stmt->bindParam(':passo3', $passo3);
        $stmt->execute();
    }
    // Redirecionar para a página de resultado após o formulário ser enviado com sucesso
    header('Location: resultado_plano_acao.php');
    exit;
}

// Buscar os dados do plano de ação já cadastrados
$planos_acao = [];

foreach ($areas as $area) {
    $area_underscore = str_replace(' ', '_', $area); // Substituir espaços por underscores
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
    <title>Plano de Ação</title>
</head>
<body>
    <h1>Plano de Ação - Tomando Decisões e Estabelecendo Metas</h1>

    <form method="POST">
        <?php foreach ($areas as $area): ?>
            <?php
                // Substituindo espaços por underscores para criar a chave do array
                $area_underscore = str_replace(' ', '_', $area);
            ?>
            <h2><?php echo htmlspecialchars($area); ?></h2>

            <label for="descricao_<?php echo $area_underscore; ?>">Descrição:</label><br>
            <input type="text" name="descricao_<?php echo $area_underscore; ?>" value="<?php echo htmlspecialchars($planos_acao[$area_underscore]['descricao'] ?? ''); ?>" required><br><br>

            <label for="prazo_<?php echo $area_underscore; ?>">Prazo:</label><br>
            <input type="date" name="prazo_<?php echo $area_underscore; ?>" value="<?php echo htmlspecialchars($planos_acao[$area_underscore]['prazo'] ?? ''); ?>" required><br><br>

            <h3>Passos:</h3>
            <label for="passo1_<?php echo $area_underscore; ?>">Passo 1:</label><br>
            <input type="text" name="passo1_<?php echo $area_underscore; ?>" value="<?php echo htmlspecialchars($planos_acao[$area_underscore]['passo1'] ?? ''); ?>"><br><br>

            <label for="passo2_<?php echo $area_underscore; ?>">Passo 2:</label><br>
            <input type="text" name="passo2_<?php echo $area_underscore; ?>" value="<?php echo htmlspecialchars($planos_acao[$area_underscore]['passo2'] ?? ''); ?>"><br><br>

            <label for="passo3_<?php echo $area_underscore; ?>">Passo 3:</label><br>
            <input type="text" name="passo3_<?php echo $area_underscore; ?>" value="<?php echo htmlspecialchars($planos_acao[$area_underscore]['passo3'] ?? ''); ?>"><br><br>

            <hr>
        <?php endforeach; ?>

        <button type="submit">Salvar Plano de Ação</button>
    </form>

</body>
</html>
