<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_nome'])) {
    header('Location: login.php');
    exit;
}

// Obter os dados do usuário logado
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nome, foto_perfil, data_nascimento FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir a foto de perfil
$foto_perfil = !empty($usuario['foto_perfil']) ? 'users/' . $usuario['foto_perfil'] : 'users/foto_padrao.png';

// Exemplo de resumo do perfil e progresso (os dados podem ser puxados do banco)
$resumo_perfil = "Você está no caminho certo para alcançar seus objetivos!";
$progresso_plano = 75; // Percentual de progresso do plano de ação (isso pode ser calculado de acordo com os dados no banco)

// Exemplo de tarefas com prazo (os dados podem ser puxados do banco)
$tarefas = [
    ['meta' => 'Estudar para a prova', 'prazo' => '15/05/2025'],
    ['meta' => 'Completar a atividade prática', 'prazo' => '20/05/2025'],
    ['meta' => 'Consultar mentor', 'prazo' => '30/05/2025']
];

// Exemplo de resultados dos testes (os dados podem ser puxados do banco)
$resultados_testes = [
    'personalidade' => 'Extrovertido',
    'inteligencia' => 'Alta capacidade lógica'
];

// Frase motivacional (pode ser feita aleatória ou estática)
$frase_motivacional = "O sucesso é a soma de pequenos esforços repetidos dia após dia.";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Principal</title>
</head>
<body>

<!-- Cabeçalho com dados do usuário -->
<header>
    <h1>Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h1>
    <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil" width="150">
    <p>Data de nascimento: <?php echo date("d/m/Y", strtotime($usuario['data_nascimento'])); ?></p>
    <form action="logout.php" method="POST">
        <button type="submit">Sair da Conta</button>
    </form>
</header>

<!-- Resumo do Perfil -->
<h2>Resumo do Perfil</h2>
<p><?php echo $resumo_perfil; ?></p>

<!-- Gráfico de Progresso do Plano de Ação -->
<h2>Progresso do Plano de Ação</h2>
<p>Percentual de metas concluídas: <?php echo $progresso_plano; ?>%</p>

    <div style="width: <?php echo $progresso_plano; ?>%; background-color: #4CAF50; height: 100%;"></div>
</div>

<!-- Próximas Tarefas/Metas -->
<h2>Próximas Tarefas/Metas</h2>
<ul>
    <?php foreach ($tarefas as $tarefa): ?>
        <li><?php echo htmlspecialchars($tarefa['meta']); ?> (Prazo: <?php echo htmlspecialchars($tarefa['prazo']); ?>)</li>
    <?php endforeach; ?>
</ul>

<!-- Resumo dos Resultados dos Testes -->
<h2>Resumo dos Resultados dos Testes</h2>
<p>Resultado do Teste de Personalidade: <?php echo htmlspecialchars($resultados_testes['personalidade']); ?></p>
<p>Resultado do Teste de Inteligência: <?php echo htmlspecialchars($resultados_testes['inteligencia']); ?></p>

<!-- Frases e Pensamentos Motivacionais -->
<h2>Frases e Pensamentos</h2>
<blockquote>
    "<?php echo $frase_motivacional; ?>"
</blockquote>

<!-- Rodapé -->
<footer>
    <p>&copy; 2025 Roberto. Todos os direitos reservados.</p>
</footer>

</body>
</html>
