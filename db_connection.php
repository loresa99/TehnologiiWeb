<?php
	$db_hostname="127.0.0.1:3306";
	$db_username="root";
	$db_password="";
	$database="Glammy";

	function initializeDatabase() {
		$db_hostname="127.0.0.1:3306";
		$db_username="root";
		$db_password="";
		$database="Glammy";


		$connection = mysqli_connect($db_hostname, $db_username, $db_password);
		if(!$connection) {
			echo"Database Connection Error...".mysqli_connect_error();
		} else {
			$sql = 'CREATE Database IF NOT EXISTS ' . $database;
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Could not create database...".mysqli_connect_error();
			}

			$sql = "CREATE Table IF NOT EXISTS $database.Category (".
				"id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
				"category_name VARCHAR(30) NOT NULL)";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Could not create table Categoty".mysqli_error($connection);
			} else {
				$sql = "SELECT * FROM $database.Category";
				$retval = mysqli_query( $connection, $sql );
				if(! $retval ) {
					echo "".mysqli_connect_error();
				}else{
					$categories = ['Incaltaminte', 'Accesorii', 'Cosmetice'];
					if(mysqli_num_rows($retval) == 0){
						foreach ($categories as &$value) {
							$sql = "INSERT INTO $database.Category (category_name) VALUES ('$value')";
							mysqli_query($connection, $sql);
						}
					}
					
				}
			}

			$sql = "CREATE Table IF NOT EXISTS $database.Subcategory (".
				"id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
				"subcategory_name VARCHAR(30) NOT NULL)";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Could not create table Subcategoty".mysqli_error($connection);
			} else {
				$sql = "SELECT * FROM $database.Subcategory";
				$retval = mysqli_query( $connection, $sql );
				if(! $retval ) {
					echo "".mysqli_connect_error();
				}else{
					$subcategory = ['FEMEI', 'BARBATI'];
					if(mysqli_num_rows($retval) == 0){
						foreach ($categories as &$value) {
							$sql = "INSERT INTO $database.Subcategory (subcategory_name) VALUES ('$value')";
							mysqli_query($connection, $sql);
						}
					}
				}
			}

			$sql = "CREATE Table IF NOT EXISTS $database.Users (".
				"id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
				"first_name VARCHAR(20) NOT NULL,".
				"last_name VARCHAR(20) NOT NULL,".
				"email VARCHAR(30) NOT NULL,".
				"password VARCHAR(20) NOT NULL,".
				"role VARCHAR(10) NOT NULL)";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Could not create table Users".mysqli_error($connection);
			}

			$sql = "CREATE Table IF NOT EXISTS $database.Products (".
				"id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
				"product_name VARCHAR(30) NOT NULL,".
				"pret INT NOT NULL,".
				"size INT NOT NULL,".
				"category INT NOT NULL,".
				"subcategory INT NOT NULL,".
				"buy_count INT NOT NULL,".
				"CONSTRAINT fk_category FOREIGN KEY (category) REFERENCES Category(id),".
				"CONSTRAINT fk_subcategory FOREIGN KEY (subcategory) REFERENCES Subcategory(id))";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Could not create table Products".mysqli_error($connection);
			}
		}

		mysqli_close($connection);
	}
	
?>