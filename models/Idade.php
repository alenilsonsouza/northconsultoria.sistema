<?php
class Idade {
	private $idade;
	
	public function __construct($nascimento, $data_final = ''){

		if(!empty($data_final)){
			$data_final = $data_final;
		}else{
			$data_final = date("Y-m-d");
		}

		// Declara a data! :P
	    $data = $nascimento;
	   
	    // Separa em dia, mês e ano
	    list($ano, $mes, $dia) = explode('-', $data);
	   
	    // Descobre que dia é hoje e retorna a unix timestamp
	    $hoje = mktime(0, 0, 0, date('m', strtotime($data_final)), date('d', strtotime($data_final)), date('Y', strtotime($data_final)));
	    // Descobre a unix timestamp da data de nascimento do fulano
	    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
	   
	    // Depois apenas fazemos o cálculo já citado :)
	    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
	    $this->idade =  $idade;	
		
	} 

	public function getIdade(){return $this->idade;}
}
