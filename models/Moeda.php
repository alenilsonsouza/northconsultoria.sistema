<?php 
class Moeda {

	public static function setValorFloat($valor){

		$novoValor = str_replace(".", "", $valor);
		$novoValor = str_replace(",", ".", $novoValor);
		$novoValor = str_replace('%', '', $novoValor) ;
		return $novoValor;

	}

	public static function  converterParaBr($valor) {
		$novaValor = number_format($valor,2,",",".");
		return $novaValor;
	}
}