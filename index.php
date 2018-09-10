<?php 
//Chamando o arquivo de configuração
require_once("config.php");

$usuario = new Usuario();
//Carregar o usuario primeiro
$usuario->loadbyId(8);
//realiza o processo de update passando o id 7
$usuario->update("teste","¨&*(@#");

echo $usuario;



/*====criando um usuário=====
$aluno = new Usuario("aluno","Senha");
//chamando o método do insert
$aluno->insert();
//como o insert irá retornar os dados do usuários pois o mesmo está inserindo via procedure, se dermos um echo em $aluno já retorna o id e a data do cadastro em um json
echo $aluno;
*/

//====Carrega um usuário usando o login e senha=======
/*$usuario = new Usuario();
$usuario->login("jose","1234567890");

echo $usuario;*/
/*
//======Carrega uma lista de usuários buscando pelo login=======
$search = Usuario:: search("jo");
echo json_encode($search);
*/

/*
//=====Carrega uma lista de usuário======
//como o método é statico não precisa ser instanciado pode chamá-lo direto
$lista = Usuario::getList();
//retorna um json
echo json_encode($lista);
*/

/* 
=== Carrega um usuário
$root = new usuario();
$root->loadbyId(3);
echo $root;
*/

/*
//A palavra new faz com que a função spl_autoload_register procure pela classe
$sql = new Sql();
//Execulta o comando no banco de dados e recebe na variável $usuários
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//mostra na tela como um json
echo json_encode($usuarios);
*/
?>