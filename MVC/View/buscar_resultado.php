<?php
require 'config.php';

if (isset($_GET['id'])) {
    $sql = "SELECT resultado FROM teste_inteligencia WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_GET['id']]);
    $teste = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($teste) {
        $resultado = json_decode($teste['resultado'], true);

        // Determina a inteligência dominante
        $inteligencia_dominante = array_keys($resultado, max($resultado))[0];

        echo json_encode([
            'resultado' => $resultado,
            'tipo' => ucfirst($inteligencia_dominante) // Converte para maiúscula a primeira letra
        ]);
    } else {
        echo json_encode([]);
    }
}
?>
