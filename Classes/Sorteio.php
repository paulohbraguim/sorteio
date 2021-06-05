<?php

require_once "Personagem.php";

Class Sorteio{

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

	public function Sortear(){

		$p = new Personagem();

		$p->carregarPersonagens();

		

	}

}