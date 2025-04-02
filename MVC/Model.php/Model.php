<?php
class Model
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function sobremim($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario)
    {
        $sql = "INSERT INTO cadastro_consumo (consumo_de_estacao, consumo_do_servidor, consumo_de_iluminacao, consumo_de_climatizacao, consumo_de_equipamentos, id_usuario) 
                VALUES (:consumo_de_estacao, :consumo_do_servidor, :consumo_de_iluminacao, :consumo_de_climatizacao, :consumo_de_equipamentos, :id_usuario)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":consumo_de_estacao", $consumo_de_estacao);
        $stmt->bindParam(":consumo_do_servidor", $consumo_do_servidor);
        $stmt->bindParam(":consumo_de_iluminacao", $consumo_de_iluminacao);
        $stmt->bindParam(":consumo_de_climatizacao", $consumo_de_climatizacao);
        $stmt->bindParam(":consumo_de_equipamentos", $consumo_de_equipamentos);
        $stmt->bindParam(":id_usuario", $id_usuario);

        return $stmt->execute();
    }

   
        
}