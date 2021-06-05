<?php 

Class Personagem {

	private $pdo;
	public $erro;

	public function __construct(){

		$databasename = 'dbsorteio';
		$user = 'root';
		$pass = 'root';
		$host = 'localhost';

		try{

	    	$this->pdo = new PDO("mysql:dbname=".$databasename.";host=".$host, $user, $pass);

		} catch(Exception $e){

			$this->erro = $e->getMessage();

		}	

	}

	public function save($nick){

		$personagem = $this->consultaNick($nick);

		if($personagem->rowCount() > 0){

			header("Location: info.php");
			die();

		}else {

			$sql = $this->pdo->prepare("INSERT INTO personagens (nick, data) VALUES(:nick, :data)");

			$sql->bindParam(':nick', $nick);
			$sql->bindParam(':data', date("Y-m-d H:i:s"));

			$sql->execute();

			header("Location: confirm.php");
			die();

		}		

	}

	public function consultarNick($nick){

		$sql = $this->pdo->query("SELECT nick FROM personagens WHERE nick = :nick");

		$sql->bindValue(':nick', $nick);

		$sql->execute();

	}

	public function carregarPersonagens(){

		$sql = $this->pdo->prepare("SELECT nick FROM personagens WHERE data = :data");

		$sql->bindValue(':data', date("Y-m-d"));

		$sql->execute();

		if($sql->rowCount() > 0){

			$personagens = $sql->fetchAll();

		}else {

			$personagens = [];
		}

		return $personagens;

	}

}