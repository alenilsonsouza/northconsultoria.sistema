<?php
class Data{

	public static function convertDate($data) {
		
		return date('d/m/Y', strtotime($data));
	}
	
	public function getMes($mes){
		switch($mes){
			case 1: $mes = "Jan";
			break;
			case 2: $mes = "Fev";
			break;
			case 3: $mes = "Mar";
			break;
			case 4: $mes = "Abr";
			break;
			case 5: $mes = "Mai";
			break;
			case 6: $mes = "Jun";
			break;
			case 7: $mes = "Jul";
			break;
			case 8: $mes = "Ago";
			break;
			case 9: $mes = "Set";
			break;
			case 10: $mes = "Out";
			break;
			case 11: $mes = "Nov";
			break;
			case 12: $mes = "Dez";
			break;
		}

		return $mes;
	}

	public function getDiaSemana($dia){
		switch ($dia) {
			case 0: $dia = "Domingo";
			break;
			case 1: $dia = "Segunda-feira";
			break;
			case 2: $dia = "Terça-feira";
			break;
			case 3: $dia = "Quarta-feira";
			break;
			case 4: $dia = "Quinta-feira";
			break;
			case 5: $dia = "Sexta-feira";
			break;
			case 6: $dia = "Sábado";
			break;
					
		}
		return $dia;
	}

	public static function getMesCompleto($mes)
	{
		switch($mes){
			case 1: $mes = "Janeiro";
			break;
			case 2: $mes = "Fevereiro";
			break;
			case 3: $mes = "Março";
			break;
			case 4: $mes = "Abril";
			break;
			case 5: $mes = "Maio";
			break;
			case 6: $mes = "Junho";
			break;
			case 7: $mes = "Julho";
			break;
			case 8: $mes = "Agosto";
			break;
			case 9: $mes = "Setembro";
			break;
			case 10: $mes = "Outubro";
			break;
			case 11: $mes = "Novembro";
			break;
			case 12: $mes = "Dezembro";
			break;
		}

		return $mes;
	}
}