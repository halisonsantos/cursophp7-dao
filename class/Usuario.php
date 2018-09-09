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
			//adicionando o resultado da primeira linha e adicionar no $row
			$row = $results[0];
			//pegar os resultados e mandar para os setters
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro'])); //DateTime já coloca no padrão de horário do banco
		}
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