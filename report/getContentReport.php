<?
include("../../libs/db.class.php");
$db = NEW DB();
$id = $_REQUEST['id'];
$sql = "SELECT report FROM report_history WHERE id=$id";
$data = $db->doSql($sql);
echo $data['report'];
?>