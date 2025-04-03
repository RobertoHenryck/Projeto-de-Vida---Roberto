<?php
session_start();
require_once 'C:\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Acesso negado. Faça login para continuar.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['usuario_id'];

    // Captura as respostas do formulário
    $respostas = [];
    for ($i = 1; $i <= 16; $i++) {
        $respostas[$i] = isset($_POST["q$i"]) ? $_POST["q$i"] : "N";
    }

    // Insere as respostas no banco de dados
    $sql = "INSERT INTO teste_inteligencia (user_id, " . implode(",", array_map(fn($i) => "q$i", range(1, 16))) . ")
            VALUES (:user_id, " . implode(",", array_map(fn($i) => ":q$i", range(1, 16))) . ")";
    
    $stmt = $pdo->prepare($sql);
    $params = [':user_id' => $user_id];
    for ($i = 1; $i <= 16; $i++) {
        $params[":q$i"] = $respostas[$i];
    }
    $stmt->execute($params);

    // Redireciona para a página de resultado
    header("Location: resultado_inteligencias.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Múltiplas Inteligências</title>
</head>
<body>

    <h2>Teste de Múltiplas Inteligências</h2>
    <form method="POST">

        <?php
        $perguntas = [
            "Gosto de aprender ouvindo músicas e sons.",
            "Tenho facilidade em resolver problemas matemáticos.",
            "Prefiro atividades físicas e esportes.",
            "Aprendo melhor lendo e escrevendo.",
            "Gosto de trabalhar em equipe e conversar com outras pessoas.",
            "Gosto de refletir sobre meus sentimentos e pensamentos.",
            "Tenho uma conexão forte com a natureza e os animais.",
            "Percebo rapidamente as emoções das pessoas ao meu redor.",
            "Sou bom em reconhecer padrões musicais e ritmos.",
            "Adoro quebra-cabeças e desafios lógicos.",
            "Tenho facilidade para aprender coreografias e movimentos.",
            "Gosto de contar histórias e escrever textos.",
            "Sou bom em falar e convencer as pessoas.",
            "Prefiro atividades individuais e gosto de momentos de reflexão.",
            "Tenho curiosidade sobre o meio ambiente e como as coisas funcionam.",
            "Entendo facilmente o comportamento e expressões das pessoas."
        ];

        $opcoes = ["A" => "Sim", "B" => "Não"];

        foreach ($perguntas as $index => $pergunta) {
            echo "<p>$pergunta</p>";
            foreach ($opcoes as $key => $value) {
                echo "<input type='radio' name='q" . ($index + 1) . "' value='$key' required> $value ";
            }
            echo "<br>";
        }
        ?>

        <br>
        <button type="submit">Enviar</button>
    </form>

</body>
</html>
