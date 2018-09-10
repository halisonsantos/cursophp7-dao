<?php 

class Usuario {
	//criando variáveis privadas
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	//criando metodos getters e setters 
	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}
	//Carregando pelo id
	public function loadById($id){
		//instanciando um objeto
		$sql = new Sql();
		//realizando o select
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(
			":ID" => $id
		));
		//verifica se existe algum registro
		// pode usar também if(isset($results[0]))
		if (count($results) > 0){

			$this->setData($results[0]);
		}
	}
	//Método que tras uma lista de usuário é estático
	public static function getList(){
		//instancia a classe Sql
		$sql = new Sql();
		//retorna o select 
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}
	public static function search($login){
		//instancia a classe Sql
		$sql = new Sql();
		//retorna o select com o nome parecido
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
				':SEARCH'=>"%".$login."%"
			));
	}
	//Uma busca autenticada conferindo se login e senha conferem para poder retornar o usuário
	 public function login($login, $password){
	 	//instanciando um objeto
		$sql = new Sql();
		//realizando o select
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(
			":LOGIN" => $login,
			":PASSWORD"=> $password
		));
		//verifica se existe algum registro
		// pode usar também if(isset($results[0]))
		if (count($results) > 0){
			//pegar os resultados e mandar para os setters que foi chamado da função setData
			$this->setData($results[0]);
		}else{

			throw new Exception("Login e/ou senha inválidos.");			
		}
	 }
	 //
	public function setData($data){
		//pegar os resultados e mandar para os setters
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro'])); //DateTime já coloca no padrão de horário do banco

	}
	//Inserir um novo usuário
	public function insert(){
		$sql = new Sql();
		//Para criar uma procedure e voltar um id
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()
			));
			if (count($results) > 0){
				$this->setData($results[0]);
			}
	}
	//Fazendo um método de atualização
	public function update($login, $password){
		//definir as variáveis dentro do objetos
		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, deslogin = :PASSWORD WHERE idusuario = :ID",array(
			':LOGIN'=>$this->getDessenha(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));

	}
	public function delete(){
		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID",array(
			':ID'=>$this->getIdusuario()
		));

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());

	}
	//criando um construtor para quando for instanciar um novo objeto Usuário já inserir login e senha
	//os parametros são iniciado com vazio, toda vez que chamar a classe Usuario terá que passar esses valores, para não afetar o que já foi feito, se chamar o vazio será preenchido se não chamar vai ta vazio para não dar erro
	public function __construct($login = "", $password = ""){
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}

	//para mostrar os dados do objeto
	public function __toString(){
		//retornando formato json
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s") //formata a data conforme especificado na função que no caso formato brasileiro

		));
	}

}

?>