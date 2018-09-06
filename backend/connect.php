<?php
	function ConnectDB($servername, $username, $password, $dbname){
		$connect = new MySQLi($servername, $username, $password, $dbname);
		return ($connect->connect_error)? null : $connect;
	}