<?php
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\MVC\Model.php\Model.php';

class Controller
{
    private $Model;

    public function __construct($pdo)
    {
        $this->Model = new Model($pdo);
    }

    public function sobre_mim($user_id, $sobre_mim)
    {
        return $this->Model->sobremim($user_id, $sobre_mim);
    }

  
}
