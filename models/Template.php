<?php
class Template extends model{
	
	public function getInfo(){

		$array = array();

		$s = new Site();
		$array['site'] = $s->getArray();

		return $array;
	}
}