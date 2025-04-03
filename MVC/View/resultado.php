<?php
session_start();
require_once 'C:\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Acesso negado. Faça login para continuar.");
}

// Captura o resultado do teste da URL
$resultado = isset($_GET['tipo']) ? $_GET['tipo'] : "Não definido";

// Mapeia os perfis com uma descrição mais detalhada
$descricao_personalidade = [
    "Líder Visionário - Você gosta de desafios e de inspirar pessoas." => "Você tem uma mente estratégica e inspiradora. Gosta de assumir o controle e levar projetos adiante, sempre motivando os outros ao seu redor.",
    "Analítico e Prático - Você é focado em lógica e organização." => "Você se destaca por sua habilidade de analisar situações e encontrar soluções práticas. Prefere estrutura e clareza em tudo que faz.",
    "Criativo e Comunicativo - Você gosta de inovação e interação." => "Você é movido pela criatividade e adora compartilhar ideias. Seu talento está em inovar e se conectar com as pessoas.",
    "Equilibrado e Adaptável - Você consegue se ajustar a qualquer situação." => "Você possui um equilíbrio impressionante entre razão e emoção. Sua flexibilidade permite que lide bem com qualquer desafio."
];

// Define a descrição do perfil com base no resultado
$descricao = isset($descricao_personalidade[$resultado]) ? $descricao_personalidade[$resultado] : "Perfil não identificado.";

// Recupera as respostas do teste para gerar o gráfico
$user_id = $_SESSION['usuario_id'];
$sql = "SELECT q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15, q16 FROM teste_personalidade WHERE user_id = :user_id ORDER BY data DESC LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$respostas = $stmt->fetch(PDO::FETCH_ASSOC);

// Conta quantas vezes cada letra foi escolhida
$pontuacao = array_count_values($respostas);

// Formata os dados para o gráfico
$labels = json_encode(["Líder", "Analítico", "Criativo", "Equilibrado"]);
$valores = json_encode([
    $pontuacao['A'] ?? 0, // Líder
    $pontuacao['B'] ?? 0, // Analítico
    $pontuacao['C'] ?? 0, // Criativo
    $pontuacao['D'] ?? 0  // Equilibrado
]);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Teste</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <h2>Seu Resultado</h2>
    <p><strong>Tipo de Personalidade:</strong> <?php echo $resultado; ?></p>
    <p><?php echo $descricao; ?></p>

    <!-- Gráfico -->
    <canvas id="graficoPersonalidade" width="300" height="300"></canvas>

    <script>
        var ctx = document.getElementById('graficoPersonalidade').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $labels; ?>,
                datasets: [{
                    label: 'Pontuação',
                    data: <?php echo $valores; ?>,
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 16
                    }
                }
            }
        });
    </script>

</body>
</html>
