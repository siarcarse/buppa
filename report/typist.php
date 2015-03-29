<?php

include '../../libs/db.class.php';
$db = NEW DB();
$type = $_REQUEST['type'];
if($type == 'show'){
	$sql = "SELECT users.id ,employee.name, employee.lastname FROM users, employee WHERE employee.id = users.employee and users.role = 12";
	$data = $db->doSql($sql);
	do {
	    $typist[] = array(
	        'id' => $data['id'], 
	        'name' => $data['name'],
	        'lastname' => $data['lastname'],
	    );
	} while ($data = pg_fetch_assoc($db->actualResults));
	echo json_encode($typist);
	die();
}
if($type == 'add'){
	$idDoc = $_REQUEST['idDoc'];
	$idTyp = $_REQUEST['idTyp'];
	$sql = "INSERT INTO users_doctor (doctor,tipeadora) values ($idDoc,$idTyp)";
	$db->doSql($sql);
	die();
}
if($type == 'delete'){
	$idDoc = $_REQUEST['idDoc'];
	$idTyp = $_REQUEST['idTyp'];
	$sql = "DELETE FROM users_doctor where doctor = $idDoc and tipeadora = $idTyp";
	$db->doSql($sql);
	die();
}
if($type == 'check'){
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM users_doctor WHERE doctor = $id";
	$data = $db->doSql($sql);
	do {
	    $typist[] = array(
	        'id' => $data['id'], 
	        'doctor' => $data['doctor'],
	        'typ' => $data['tipeadora'],
	    );
	} while ($data = pg_fetch_assoc($db->actualResults));
	echo json_encode($typist);
}
die();

?>