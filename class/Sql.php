<?php 
//Essa classe é criada para ter os comandos em comum do PDO
class Sql extends PDO {
	//criando uma variável privada de conexão
	private $conn;
	//Quando for criar um objeto dessa classe a conexão já será criada automaticamente pelo método construtor
	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
	}
	//função para que outros métudos utilizem a associação dos valores com os parâmetros
	private function setParams($statement, $parameters = array()){
		//associar os valores com os parametros
		foreach ($parameters as $key => $value) {
			//chamando o método que foi criado  que associa valor de um parâmetro
			$this->setParam($statement, $key, $value);
		
		}
	}
	//Associando o valore de um parâmentro 
	private function setParam($statement, $key, $value){
		$statement->bindParam($key, $value);
	}

	//executar os comandos sql
	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);
		//Chamando o setParams que sabe como fazer o set de cada um dos parâmetros
		$this->setParams($stmt,$params);
		//executa o comando no banco de dados, o retorno é tratado em outro método
		$stmt->execute();
		//retornando o objeto
		return $stmt;

	}
	//Criando um médoto para o select que retorna um array 
	public function select($rawQuery, $params = array()):array {
		//Preparar, setar os parametros chamamos o método query
		$stmt = $this->query($rawQuery, $params);
		//O fetchAll é um array multidimensional, o FETCH_ASSOC é uma constante da classe PDO que trás apenas os índices associativos
		return $stmt->fetchAll(PDO::FETCH_ASSOC);


	}

}

?>