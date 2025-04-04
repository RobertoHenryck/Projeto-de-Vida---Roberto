<?php
class Model
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Atualiza ou insere o texto "sobre mim" do usuário
    public function sobremim($user_id, $sobre_mim)
    {
        $sql = "UPDATE users SET sobre_mim = :sobre_mim WHERE id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':sobre_mim' => $sobre_mim,
            ':user_id' => $user_id
        ]);
    }

   
}
