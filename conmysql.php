<?php
		$host = '127.0.0.1';
		$username = 'root';
		$password = '1010100';
		$db_name = 'gjd';
		
		$connID =new mysqli($host, $username, $password, $db_name);
		$connID->query("set names utf8");

?>