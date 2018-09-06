<?php
	function showAll($table, $connect){
		/*
		* Funcion para retornar todos los clientes actualmente guardados
		*
		*/
		if( isset($connect) ){
			$sql = "SELECT * FROM ".$table;
			$result = $connect->query($sql);
			return $result;
		}
		return null;
	}
	function get($id, $table, $connect){
		/*
		* Funcion para retornar a un solo cliente de la base de datos
		*
		*/
		if( isset($connect) ){
			$sql = "SELECT * FROM ".$table." WHERE id=".$connect->real_escape_string($id)." LIMIT 1";
			$result = $connect->query($sql);
			return $result;
		}
		return null;
	}
	function isNotSaved($keys, $values, $table, $connect){
		/*
		* Funcion para verificar si alguno de los campos proporcionados por un nuevo cliente coincide con otro ya * suministrado por otro cliente
		*
		*/
		for($i=0; $i<count($keys); $i++){
			$sql = 'SELECT * FROM '.$table.' '.$keys[$i].'=\''.$values[$i].'\'';
			$result = $connect->query($sql);
			if($result->num_rows > 0)
				return false;
		}
		return true;
	}
