<?php 
//função para procurar o nome da classe
spl_autoload_register(function($class_name){
	//cria uma variável para receber o nome da classe
	$filename = "class".DIRECTORY_SEPARATOR.$class_name.".php"; //DIRECTORY_SEPARATOR vai identificar o sistema operacional e colocar a barra de acordo com o so
	//se a classe existir chama ela
	if(file_exists(($filename))){
		require_once($filename);
	}

});

?>