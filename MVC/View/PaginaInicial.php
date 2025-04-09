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
    <title>Página Inicial</title>

    <!-- Link para o arquivo CSS -->
    <link rel="stylesheet" href="/MVC/View/css/Página_inicial.css">
</head>
<body>

<!-- Cabeçalho com dados do usuário -->
<header class="header">
    <h1 class="header__title">Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h1>
    <img class="header__photo" src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil" width="150">
    <p class="header__birthdate">Data de nascimento: <?php echo date("d/m/Y", strtotime($usuario['data_nascimento'])); ?></p>
    <form class="header__logout-form" action="logout.php" method="POST">
        <button class="header__logout-button" type="submit">Sair da Conta</button>
    </form>
</header>

<!-- Resumo do Perfil -->
<section class="section section--summary">
    <h2 class="section__title">Resumo do Perfil</h2>
    <p class="section__content"><?php echo $resumo_perfil; ?></p>
</section>

<!-- Gráfico de Progresso do Plano de Ação -->
<section class="section section--progress">
    <h2 class="section__title">Progresso do Plano de Ação</h2>
    <div class="progress">
        <p class="progress__text">Percentual de metas concluídas: <?php echo $progresso_plano; ?>%</p>
        <div class="progress__bar-container">
            <div class="progress__bar" style="width: <?php echo $progresso_plano; ?>%;"></div>
        </div>
    </div>
</section>

<!-- Próximas Tarefas/Metas -->
<section class="section section--tasks">
    <h2 class="section__title">Próximas Tarefas/Metas</h2>
    <ul class="tasks__list">
        <?php foreach ($tarefas as $tarefa): ?>
            <li class="tasks__item"><?php echo htmlspecialchars($tarefa['meta']); ?> (Prazo: <?php echo htmlspecialchars($tarefa['prazo']); ?>)</li>
        <?php endforeach; ?>
    </ul>
</section>

<!-- Resumo dos Resultados dos Testes -->
<section class="section section--results">
    <h2 class="section__title">Resumo dos Resultados dos Testes</h2>
    <p class="results__text">Resultado do Teste de Personalidade: <?php echo htmlspecialchars($resultados_testes['personalidade']); ?></p>
    <p class="results__text">Resultado do Teste de Inteligência: <?php echo htmlspecialchars($resultados_testes['inteligencia']); ?></p>
</section>

<!-- Frases e Pensamentos Motivacionais -->
<section class="section section--quotes">
    <h2 class="section__title">Frases e Pensamentos</h2>
    <blockquote class="quote">
        "<?php echo $frase_motivacional; ?>"
    </blockquote>
</section>

<!-- Rodapé com Direitos Autorais -->
<footer class="footer">
    <p class="footer__text">&copy; 2025 Roberto. Todos os direitos reservados.</p>
</footer>

</body>
</html>