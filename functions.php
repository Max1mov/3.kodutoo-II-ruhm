<?php

	require_once("../config.php");
	require_once("User.class.php");
	
	
	$database = "if15_vitamak";
	
	session_start();
	
	//loome ab'i �henduse
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);
	
	//Uus instants klassist User
	$User = new User($mysqli);
	
	//var_dump($User->connection);
	//loome uue funktsiooni, et k�sida ab'ist andmeid
	
	
	
	
	function getUserData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM user_kd");
		$stmt->bind_result($id, $user_email);
		$stmt->execute();

		
		// t�hi massiiv kus hoiame objekte (1 rida andmeid)
		$array = array();
		
		// tee ts�klit nii mitu korda, kui saad 
		// ab'ist �he rea andmeid
		while($stmt->fetch()){
			
			// loon objekti iga while ts�kli kord
			$car = new StdClass();
			$car->id = $id;
			$car->email = $user_email;
			
			// lisame selle massiivi
			array_push($array, $car);
			//echo "<pre>";
			//var_dump($array);
			//echo "</pre>";
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $array;
		
		
	}
	
	function updateComment($send_tekst){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		echo $mysqli->error;
		$stmt = $mysqli->prepare("INSERT INTO text_kd (user_id, text) VALUES (?,?)");
		$stmt->bind_param("is", $_SESSION["id_from_db"], $send_tekst);
		
		// kas �nnestus salvestada
		if($stmt->execute()){
			// �nnestus
			echo "EDUKALT SALVESTANUD!";
		}
		
		
		$stmt->close();
		$mysqli->close();
		
		
	}
	
	function getTextData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT post_kd, user_id, text FROM text_kd");
		$stmt->bind_result($post_kd, $user_id, $text);
		$stmt->execute();

		
		// t�hi massiiv kus hoiame objekte (1 rida andmeid)
		$array = array();
		
		// tee ts�klit nii mitu korda, kui saad 
		// ab'ist �he rea andmeid
		while($stmt->fetch()){
			
			// loon objekti iga while ts�kli kord
			$post = new StdClass();
			$post->post_kd = $post_kd;
			$post->user_id = $user_id;
			$post->text = $text;
			
			// lisame selle massiivi
			array_push($array, $post);
			//echo "<pre>";
			//var_dump($array);
			//echo "</pre>";
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $array;
		
		
	}
	
	function getEmailData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT email FROM user_kd");
		$stmt->bind_result($table_email);
		$stmt->execute();

		
		// t�hi massiiv kus hoiame objekte (1 rida andmeid)
		$array = array();
		
		// tee ts�klit nii mitu korda, kui saad 
		// ab'ist �he rea andmeid
		while($stmt->fetch()){
			
			// loon objekti iga while ts�kli kord
			$tablenew = new StdClass();
			$tablenew->emailtable = $table_email;
			
			// lisame selle massiivi
			array_push($array, $tablenew);
			//echo "<pre>";
			//var_dump($array);
			//echo "</pre>";
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $array;
		
		
	}

?>