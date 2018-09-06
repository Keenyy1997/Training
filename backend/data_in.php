<?php
	function insert($keys, $values, $table, $connect){
		/*
		* Funcion para insertar clientes en la base de datos
		*
		*/
		$sql = 'INSERT INTO '.$table.' (';

		for($i=0;$i<count($keys);$i++){
			$sql .= $keys[$i];
			if( $i != count($keys) -1)
				$sql .= ', ';
		}
		$sql .= ') VALUES (';
		for($i=0;$i<count($values);$i++){
			$sql .= '\''.$connect->real_escape_string($values[$i]).'\'';
			if( $i != count($values) -1)
				$sql .= ', ';
		}
		$sql .= ')';

		if($connect->query($sql) === true)
			return true;
		print_r($connect->error);
		exit();
	}

	function update($id, $keys, $values, $table, $connect){
		/*
		* Funcion para actualizar la informacion de los clientes en la base de datos
		*
		*/
		$sql = 'UPDATE '.$table.' SET ';

		for($i=0;$i<count($keys);$i++){
			$sql .= $keys[$i].'=';
			$sql .= '\''.$connect->real_escape_string($values[$i]).'\'';
			if( $i != count($keys) -1)
				$sql .= ', ';
		}
		$sql .= ' WHERE id='.$connect->real_escape_string($id);
		if($connect->query($sql) === true)
			return true;
		print_r($connect->error);
		exit();
	}

	function delete($id, $table, $connect){
		/*
		* Funcion para borrar clientes de la base de datos
		*
		*/
		$sql = 'DELETE FROM '.$table.' WHERE id='.$connect->real_escape_string($id);
		if($connect->query($sql) === true)
			return true;
		print_r($connect->error);
		exit();
	}