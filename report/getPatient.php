<?
include("../../libs/db.class.php");
$db = NEW DB();
$calendar = $_REQUEST['calendar'];
$sql = "SELECT name , lastname, rut from patient where id = (SELECT patient FROM calendar WHERE id=$calendar) ";
$data = $db->doSql($sql);
echo json_encode($data);
?>