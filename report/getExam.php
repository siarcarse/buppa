<?
include("../../libs/db.class.php");
$db = NEW DB();
$calendar_exam = $_REQUEST['calendar_exam'];
$sql = "SELECT name from exam where id = (SELECT exam FROM calendar_exam WHERE id=$calendar_exam) ";
$data = $db->doSql($sql);
echo json_encode($data);
?>