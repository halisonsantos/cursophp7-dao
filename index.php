<?php 
//Chamando o arquivo de configuração
require_once("config.php");
//A palavra new faz com que a função spl_autoload_register procure pela classe
$sql = new Sql();
//Execulta o comando no banco de dados e recebe na variável $usuários
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//mostra na tela como um json
echo json_encode($usuarios);

?>